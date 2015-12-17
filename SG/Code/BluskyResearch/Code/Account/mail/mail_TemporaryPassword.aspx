<%@ Page Language="VB" AutoEventWireup="false" ClassName="MailTemporaryPassword_Front" CodeFile="mail_TemporaryPassword.aspx.vb" Inherits="MailTemporaryPassword_Behind" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head runat="server">
  <title></title>
</head>
<body>
    <p>
        A new password has been requested for your <%=ConfigurationManager.AppSettings("site_name") %> account.
    </p>
    <p>
        Your temporary password is: <!-- secretcode -->
    </p>
    <p>
        Please click the link below to create a new password for your account.<br />
        <a href="http://<%=HostName %>/reset-password.aspx?email=<!-- email -->&code=<!-- secretcode -->">
            http://<%=HostName %>/reset-password.aspx?email=<!-- email -->&code=<!-- secretcode -->
        </a>
    </p>
        <br />
        <br />
    <hr />
    <p>
        BluSky Marketing Limited<br />
        The Old Doctor's Surgery, 4 West End, Exton, Oakham, Rutland, LE15 8BD<br /><br />
 
        T: 01572 420 012<br />
        D: 0845 050 8304<br />
        F: 01572 812 705<br />
        W: <a href="http://login.bluskyresearch.com">http://login.bluskyresearch.com</a><br />
    </p>
</body>
</html>
