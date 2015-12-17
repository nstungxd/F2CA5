<%@ Application Language="VB" %>
<%@ Import Namespace="PingLibrary" %>
<%@ Import Namespace="System.Web.Routing" %>


<script runat="server">

    Sub Application_Start(ByVal sender As Object, ByVal e As EventArgs)
        ' Code that runs on application startup
        RegisterRoutes(RouteTable.Routes)
    End Sub
    
    Sub Application_End(ByVal sender As Object, ByVal e As EventArgs)
        ' Code that runs on application shutdown
    End Sub
         
    Sub Application_Error(ByVal sender As Object, ByVal e As EventArgs)
        
        If Not (Request.Url.Host.ToLower.StartsWith("localhost") OrElse Request.Url.Host.ToLower.StartsWith("uat")) Then

        '# Get exception details
        Dim ex As Exception = HttpContext.Current.Server.GetLastError()

        If TypeOf ex Is HttpUnhandledException AndAlso ex.InnerException IsNot Nothing Then
            ex = ex.InnerException
        End If
        
        If ex IsNot Nothing Then

            '# Send data & log
            Try
                
                Dim Subject As String = ex.Message & " - " & Request.RawUrl
               
                Dim Body As String = String.Format("An unhandled exception occurred on {3}:{0}Message: {1}{0}{0} Stack Trace:{0}{2}", System.Environment.NewLine, ex.Message, ex.StackTrace, Request.RawUrl)
                
                If ex.Message.Contains("EventValidation") Then
                    Body &= System.Environment.NewLine & System.Environment.NewLine & "URL: " & Request.RawUrl
                    Body &= System.Environment.NewLine & System.Environment.NewLine & " Form Data: " & System.Environment.NewLine & HttpContext.Current.Request.Form.ToString().Replace("&", System.Environment.NewLine) & System.Environment.NewLine & " Query Data: " & HttpContext.Current.Request.QueryString.ToString() & System.Environment.NewLine
                    Body &= System.Environment.NewLine & System.Environment.NewLine & "Host Address: " & HttpContext.Current.Request.UserHostAddress
                    Body &= System.Environment.NewLine & System.Environment.NewLine & "Host Name: " & HttpContext.Current.Request.UserHostName
                End If
                
               ' EmailLibrary.SendErrorEmail(Body, Subject)
                DataLogic.LogError(ex.Message, "Application_Error")
                
            Catch
            End Try
            
            '# Redirect
            Response.Clear()

            Dim httpException As HttpException = TryCast(ex, HttpException)
            Dim RedirectURL As String = "/SiteError.aspx?aspxerrorpath=" & Request.Url.AbsolutePath
            
            '# Send data & log
            Try
                If httpException IsNot Nothing Then
                    '#It's an Http Exception, Let's handle it.
                    Select Case httpException.GetHttpCode()
                        Case 404
                            '# Page not found.
                            RedirectURL = "/404.aspx?errorpage=" & Request.Url.AbsolutePath
                            Exit Select
                       Case Else
                            Exit Select
                    End Select
                End If
            Catch
            End Try
            
          '  '# Clear the error on server.
            Server.ClearError()

            '# Avoid IIS7 getting in the middle
            Response.TrySkipIisCustomErrors = True

            '# Redirect to specified error page
            Response.Redirect(RedirectURL)
            
        End If
            
        End If
                
    End Sub

    Sub Session_Start(ByVal sender As Object, ByVal e As EventArgs)
        ' Code that runs when a new session is started
    End Sub

    Sub Session_End(ByVal sender As Object, ByVal e As EventArgs)
        ' Code that runs when a session ends. 
        ' Note: The Session_End event is raised only when the sessionstate mode
        ' is set to InProc in the Web.config file. If session mode is set to StateServer 
        ' or SQLServer, the event is not raised.
    End Sub
       
    Shared Sub RegisterRoutes(ByVal routes As RouteCollection)
        
        routes.Ignore("{resource}.axd/{*pathInfo}")
        routes.Ignore("Telerik.Web.UI.{resource}.aspx/{*pathInfo}")
        routes.Ignore("Controls/Telerik.Web.UI.{resource}.aspx/{*pathInfo}")
        routes.Ignore("404.aspx")
        routes.Ignore("SiteError.aspx")
        routes.Ignore("admin/{*pathInfo}")
                     
        '# Site
        routes.MapPageRoute("ContentPage", "{Content}.aspx", "~/Content.aspx")
        routes.MapPageRoute("SiteSection", "{Section}/", "~/Section.aspx")
        routes.MapPageRoute("SiteSectionDefault", "{Section}/Default.aspx", "~/Section.aspx")
        routes.MapPageRoute("SiteContent", "{Section}/{Content}.aspx", "~/Content.aspx")
       
    End Sub
       
</script>