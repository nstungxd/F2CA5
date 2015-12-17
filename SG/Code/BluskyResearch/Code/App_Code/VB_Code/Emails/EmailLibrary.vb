Imports Microsoft.VisualBasic
Imports System.Data
Imports System.Data.SqlClient
Imports System.Net.Mail
Imports System.Security.Cryptography.X509Certificates
Imports System.Security.Cryptography.Pkcs
Imports System.IO

Namespace PingLibrary
    Public NotInheritable Class EmailLibrary

#Region "Email Placeholders"

        '# User Firstname
        Protected Const EmailUserFirstname As String = "[#user_firstname]"

        '# Order Reference
        Protected Const EmailOrderReference As String = "[#order_ref]"

        '# Order Summary
        Protected Const EmailOrderSummary As String = "[#order_summary]"

        '# Delivery Type
        Protected Const EmailDeliveryType As String = "[#delivery_name]"

        '# Courier
        Protected Const EmailCourier As String = "[#courier]"

        '# Tracking Number
        Protected Const EmailTrackingNumber As String = "[#tracking_number]"

        '# Event Name
        Protected Const EventName As String = "[#event_name]"

        '# Event Name
        Protected Const BlogName As String = "[#blog_name]"

#End Region

#Region "Data Functions"
        Public Shared Function GetEmailCopyByID(ByVal ID As Integer) As DataRow
            Return Data.Connect.GetDataRow("SELECT * FROM EmailCopy WHERE Active = 1 AND EmailCopyID = " & ID.ToString())
        End Function

        Public Shared Function FormatEmailBody(ByVal BodyCopy As String, ByVal Placeholder As String, ByVal TextToInsert As String) As String
            Return BodyCopy.Replace(Placeholder, TextToInsert)
        End Function

        Public Shared Function UserRegistrationEmailBody(ByVal Name As String, ByVal Email As String, ByVal Info As String) As String
            Return String.Format("New user registration {0}{0}Name: {1}{0}Email: {2}{0}Info: {3}{0}{0}", "<br />", Name, Email, Info)
        End Function

        Public Shared Function ContactEnquiryEmailBody(ByVal Name As String, ByVal Email As String, ByVal Enquiry As String) As String
            Return String.Format("New contact enquiry {0}{0}Name: {1}{0}Email: {2}{0}Enquiry: {3}{0}{0}", "<br />", Name, Email, Enquiry)
        End Function

        Public Shared Function NewsletterSignUpEmailBody(ByVal Name As String, ByVal Email As String, ByVal Info As String) As String
            Return String.Format("New newsletter sign-up {0}{0}Name: {1}{0}Email: {2}{0}Info: {3}{0}{0}", "<br />", Name, Email, Info)
        End Function

        Public Shared Function ForgotPasswordEnquiryEmailBody(ByVal Email As String) As String
            Return String.Format("There has been a new Forgotten Details Request for: {1}{0}{0}", "<br />", Email)
        End Function
#End Region

#Region "General Send Functions"
        Public Shared Function SendEmail(ByVal Subject As String, ByVal Body As String, Optional ByVal ToAddress As String = "", Optional ByVal FromAddress As String = "") As Boolean

            Dim result As Boolean = False
            Dim mm As New MailMessage()

            Try
                '# From Address
                If String.IsNullOrEmpty(FromAddress) Then
                    FromAddress = ConfigurationManager.AppSettings("mail_from")
                End If

                mm.From = New MailAddress(FromAddress)

                '# To Address(es)
                If String.IsNullOrEmpty(ToAddress) Then
                    ToAddress = ConfigurationManager.AppSettings("mail_to")
                End If

                Dim ToAddressList As String() = ToAddress.Replace(" ", "").Split(",")
                For Each add As String In ToAddressList
                    mm.To.Add(New MailAddress(add))
                Next

                If Not String.IsNullOrEmpty(ToAddress) AndAlso Not ToAddress.Contains("ping-media.co.uk") Then
                    mm.Bcc.Add(New MailAddress("tom@ping-media.co.uk"))
                End If

                mm.Subject = Subject
                mm.Body = Body
                mm.IsBodyHtml = True

                '# Log Email
                DataLogic.AddEmailLog(ToAddress, FromAddress, Subject, Body)

                Dim smtp As SmtpClient = New SmtpClient(ConfigurationManager.AppSettings("mail_server"))
                smtp.Credentials = New System.Net.NetworkCredential("mail@secureping", "P0pc0rn")
                smtp.Send(mm)

                result = True

            Catch ex As Exception
                DataLogic.LogError(Subject & " email: " & ex.Message, "SendEmail()")
                result = False
            End Try

            Return result

        End Function

        Shared Function SendSecureEmail(ByVal Subject As String, ByVal Body As String, Optional ByVal ToAddress As String = "", Optional ByVal FromAddress As String = "") As Boolean

            Dim result As Boolean = False
            Dim mm As New MailMessage()
 
            Try

                Dim SigningCertPath As String = "C:\Users\Tom\Documents\Ping Media\cert\emails\emailCert.pfx"
                Dim EncryptingCertPath As String = "C:\Users\Tom\Documents\Ping Media\cert\emails\emailCert.cer"

                Dim SignCert As New X509Certificate2(SigningCertPath, "p1ngp0ng")
                Dim EncryptCert As New X509Certificate2(EncryptingCertPath, "")

                Dim Message As New StringBuilder()
                Message.AppendLine("Content-Type: text/html; charset=""iso-8859-1""") '# TODO: For performance reasons this should be changed to nested IF statements
                Message.AppendLine("Content-Transfer-Encoding: 7bit")
                Message.AppendLine()
                Message.AppendLine(Body)

                Dim BodyBytes As Byte() = Encoding.ASCII.GetBytes(Message.ToString())
                Dim ECms As New EnvelopedCms(New ContentInfo(BodyBytes))
                Dim Recipient As New CmsRecipient(SubjectIdentifierType.IssuerAndSerialNumber, EncryptCert)
                ECms.Encrypt(Recipient)

                Dim EncryptedBytes As Byte() = ECms.Encode()
                Dim Cms As New SignedCms(New ContentInfo(EncryptedBytes))
                Dim Signer As New CmsSigner(SubjectIdentifierType.IssuerAndSerialNumber, SignCert)
                Cms.ComputeSignature(Signer)
                Dim SignedBytes As Byte() = Cms.Encode()

                '# From Address
                If String.IsNullOrEmpty(FromAddress) Then
                    FromAddress = ConfigurationManager.AppSettings("mail_from")
                End If

                mm.From = New MailAddress(FromAddress)

                '# To Address(es)
                If String.IsNullOrEmpty(ToAddress) Then
                    ToAddress = ConfigurationManager.AppSettings("mail_to")
                End If

                ToAddress = "test@ping-media.co.uk"

                Dim ToAddressList As String() = ToAddress.Replace(" ", "").Split(",")
                For Each add As String In ToAddressList
                    mm.To.Add(New MailAddress(add))
                Next

                mm.Subject = Subject

                Dim ms As New MemoryStream(EncryptedBytes)
                Dim av As New AlternateView(ms, "application/pkcs7-mime; smime-type=signed-data;name=smime.p7m")
                mm.AlternateViews.Add(av)

                mm.IsBodyHtml = True

                '# Log Email
                DataLogic.AddEmailLog(ToAddress, FromAddress, Subject, "encrypted")

                Dim smtp As SmtpClient = New SmtpClient(ConfigurationManager.AppSettings("mail_server"))
                smtp.Credentials = New System.Net.NetworkCredential("mail@secureping", "P0pc0rn")
                smtp.Send(mm)

                result = True

            Catch ex As Exception
                DataLogic.LogError(Subject & " email: " & ex.Message, "SendSecureEmail()")
                result = False
            End Try

            Return result

        End Function

        Public Shared Function SendSystemEmail(ByVal EmailCopyID As Integer, Optional ByVal EmailRecipients As String = "", Optional ByVal BodyCopy As String = "", Optional ByVal OverrideBodyCopy As Boolean = False) As Boolean

            '# Get email info
            Dim EmailCopy As DataRow = GetEmailCopyByID(EmailCopyID)

            If EmailCopy IsNot Nothing Then

                '# Subject
                Dim Subject As String = DataFunctions.GetColumnFromDataRow(EmailCopy, "Subject")

                '# Body
                Dim Body As String = String.Empty
                If Not OverrideBodyCopy Then
                    Body = DataFunctions.GetColumnFromDataRow(EmailCopy, "BodyCopy") & BodyCopy
                Else
                    Body = BodyCopy
                End If

                '# FooterCopy
                Body &= "<br />" & DataFunctions.GetColumnFromDataRow(EmailCopy, "FooterCopy")

                '# Recipients
                Dim Recipients As String = ""
                If Not String.IsNullOrEmpty(EmailRecipients) Then
                    Recipients = EmailRecipients
                Else
                    Recipients = DataFunctions.GetColumnFromDataRow(EmailCopy, "Recipients")
                End If

                '# Sender
                Dim Sender As String = DataFunctions.GetColumnFromDataRow(EmailCopy, "SenderAddress")

                '# Send email and get result
                Return SendEmail(Subject, Body, Recipients, Sender)

            Else
                Return SendErrorEmail("Problem sending email for EmailCopy: " & EmailCopyID)
            End If

        End Function

        Public Shared Function SendSystemEmailWithPlaceholder(ByVal EmailCopyID As Integer, ByVal Placeholder As String, ByVal TextToInsert As String, Optional ByVal EmailRecipients As String = "") As Boolean

            '# Get email info
            Dim EmailCopy As DataRow = GetEmailCopyByID(EmailCopyID)

            If EmailCopy IsNot Nothing Then

                '# Subject
                Dim Subject As String = DataFunctions.GetColumnFromDataRow(EmailCopy, "Subject")

                '# Body
                Dim Body As String = FormatEmailBody(DataFunctions.GetColumnFromDataRow(EmailCopy, "BodyCopy"), Placeholder, TextToInsert)

                '# FooterCopy
                Body &= "<br />" & DataFunctions.GetColumnFromDataRow(EmailCopy, "FooterCopy")

                '# Recipients
                Dim Recipients As String = ""
                If Not String.IsNullOrEmpty(EmailRecipients) Then
                    Recipients = EmailRecipients
                Else
                    Recipients = DataFunctions.GetColumnFromDataRow(EmailCopy, "Recipients")
                End If

                '# Sender
                Dim Sender As String = DataFunctions.GetColumnFromDataRow(EmailCopy, "SenderAddress")

                '# Send email and get result
                Return SendEmail(Subject, Body, Recipients, Sender)

            Else
                Return SendErrorEmail("Problem sending email for EmailCopy: " & EmailCopyID)
            End If

        End Function

        Public Shared Function SendSecureSystemEmail(ByVal EmailCopyID As Integer, Optional ByVal EmailRecipients As String = "", Optional ByVal BodyCopy As String = "", Optional ByVal OverrideBodyCopy As Boolean = False) As Boolean

            '# Get email info
            Dim EmailCopy As DataRow = GetEmailCopyByID(EmailCopyID)

            If EmailCopy IsNot Nothing Then

                '# Subject
                Dim Subject As String = DataFunctions.GetColumnFromDataRow(EmailCopy, "Subject")

                '# Body
                Dim Body As String = String.Empty
                If Not OverrideBodyCopy Then
                    Body = DataFunctions.GetColumnFromDataRow(EmailCopy, "BodyCopy") & BodyCopy
                Else
                    Body = BodyCopy
                End If

                '# FooterCopy
                Body &= "<br />" & DataFunctions.GetColumnFromDataRow(EmailCopy, "FooterCopy")

                '# Recipients
                Dim Recipients As String = ""
                If Not String.IsNullOrEmpty(EmailRecipients) Then
                    Recipients = EmailRecipients
                Else
                    Recipients = DataFunctions.GetColumnFromDataRow(EmailCopy, "Recipients")
                End If

                '# Sender
                Dim Sender As String = DataFunctions.GetColumnFromDataRow(EmailCopy, "SenderAddress")

                '# Send email and get result
                Return SendSecureEmail(Subject, Body, Recipients, Sender)

            Else
                Return SendErrorEmail("Problem sending email for EmailCopy: " & EmailCopyID)
            End If

        End Function
#End Region

#Region "Error Email"
        Public Shared Function SendErrorEmail(ByVal ErrorMsg As String, Optional ByVal ErrorSubject As String = "") As Boolean

            '# Site Name
            Dim SiteName As String = ConfigurationManager.AppSettings("site_name")

            '# Subject
            Dim Subject As String = "Site Error - " & SiteName & ": " & ErrorSubject

            '# Body
            Dim Body As String = String.Format(String.Concat( _
                                                "There was an error on {2}{0}{0}", _
                                                "Error message: {1} {0}{0} "), "<br />", ErrorMsg, SiteName)

            '# Send email and get result
            Return SendEmail(Subject, Body, "tom@ping-media.co.uk", "")

        End Function
#End Region

#Region "Site Emails"

#Region "Forgot Password"
        Public Shared Function SendForgotPasswordEmailToAdmin(ByVal EmailAddress As String) As Boolean
            Return SendEmail("Forgotten Details Request", ForgotPasswordEnquiryEmailBody(EmailAddress))
        End Function
#End Region

#Region "User"
        Public Shared Function SendUserRegistrationEmailToUser(ByVal EmailAddress As String) As Boolean
            Return SendSystemEmail(2, EmailAddress)
        End Function

        Public Shared Function SendUserRegistrationEmailToAdmin(ByVal Name As String, ByVal EmailAddress As String, Optional ByVal Info As String = "") As Boolean
            Return SendEmail("New user registration", UserRegistrationEmailBody(Name, EmailAddress, ""))
        End Function
#End Region

#End Region

    End Class
End Namespace
