<%@ Page Language="VB" AutoEventWireup="false" CodeFile="text-details.aspx.vb" Inherits="Surveys_text_details" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="language" content="en-UK" />

    <meta name="author" content="Ping media" /> 

    <title>BluSky Research - Responses</title>    
    
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="/apple-touch-icon.png" />
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png" />

    <!-- stylesheets -->
    <link href="/media/styles/ping.base.css?v=3" rel="stylesheet" type="text/css" media="all" />
    <link href="/media/styles/ping.styles.css?v=3" rel="stylesheet" type="text/css" media="all" />
    <link href="/media/styles/ping.plugins.css?v=3" rel="stylesheet" type="text/css" media="all" />
    <link href="/media/styles/ping.print.css?v=3" rel="stylesheet" type="text/css" media="print" />
    <link href="/media/styles/uniform.default.css" rel="stylesheet" type="text/css" media="all" />
    <!--[if IE]><link rel="stylesheet" type="text/css" href="/media/styles/ping.ie.css?v=3" media="all" /><![endif]-->

    <!-- Javascript -->
	<script src="https://secureping.co.uk/safe/scripts/libs/modernizr-2.6.2-respond-1.1.0.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://secureping.co.uk/safe/scripts/jquery.min.js"></script>
</head>
<body>
    <form id="form1" runat="server">

        <asp:Panel runat="server" ID="pnlTextValues" CssClass="si_modal_textvalues">
            <div class="s_modal_inner clearfix">
                <asp:label runat="server" ID="lblTextValuesTitle" CssClass="title clearfix" />

                <div class="s_modal_body clearfix">
                    <asp:ListView runat="server" ID="lvTextValues" ItemPlaceholderID="phTextAnswer">
                        <LayoutTemplate>
                            <div class="si_m_col_list">
                                <div class="si_m_row">
                                    <div class="si_m_row_item si_m_row_data si_m_row_item_left bold">Answers:</div>
                                    <div class="si_m_row_item si_m_row_item_right bold">Result Set:</div>
                                </div>
                                <asp:PlaceHolder runat="server" ID="phTextAnswer" />
                            </div>                                    
                        </LayoutTemplate>
                        <ItemTemplate>    
                            <div class="si_m_row">
                                <div class="si_m_row_item si_m_row_data si_m_row_item_left">
                                    <%# Eval("AnswerValue")%>
                                </div>
                                <div class="si_m_row_item si_m_row_item_right">
                                    <span class="si_row_data_count"><%# Eval("CurrentResponseID")%></span>
                                </div>
                            </div>
                        </ItemTemplate>
                        <AlternatingItemTemplate>    
                            <div class="si_m_row si_m_row_alt">
                                <div class="si_m_row_item si_m_row_data si_m_row_item_left">
                                    <%# Eval("AnswerValue")%>
                                </div>
                                <div class="si_m_row_item si_m_row_item_right">
                                    <span class="si_row_data_count"><%# Eval("CurrentResponseID")%></span>
                                </div>
                            </div>
                        </AlternatingItemTemplate>
                        <EmptyDataTemplate>
                            <div class="si_row si_row_data">
                                No results
                            </div>
                        </EmptyDataTemplate>
                    </asp:ListView>
                </div>

                <a href="javascript:self.close();" class="btn_site s_modal_close s_modal_textvalues_close">Close</a>
                <a href="javascript:window.print()" class="btn_site s_modal_print s_modal_textvalues_print">Print</a>
            </div>
        </asp:Panel>

    </form>
</body>
</html>
