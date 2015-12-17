<%@ Page Title="" Language="VB" MasterPageFile="~/Site.master" AutoEventWireup="false" CodeFile="Default.aspx.vb" Inherits="Surveys_Default" %>

<asp:Content ID="Content1" ContentPlaceHolderID="HeadContent" Runat="Server">
    <link href="/Media/Styles/redmond.jquery-ui.css" rel="stylesheet" />
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="http://canvg.googlecode.com/svn/trunk/rgbcolor.js"></script>
    <script type="text/javascript" src="http://canvg.googlecode.com/svn/trunk/canvg.js"></script>

    <script type="text/javascript">
        function LoadGraph(eleID, resultArray, title) {
            try {
            google.load("visualization", "1", { packages: ["corechart"] });
            google.setOnLoadCallback(drawChart);

                //Run some code here

            function drawChart() {
                var data = google.visualization.arrayToDataTable(resultArray);

                var options = {
                    title: '',
                    colors: ['#008BD2', '#DC3912', '#FFCD00', '#10B618', '#994499', '#0099C6', '#B82E2E', '#316395', '#66AA00', '#DD4477', '#BBCCED', '#80C65A', '#FF0000', '#16c78e', '#0e6e82', '#b39700'],
                    tooltip: { text: 'value' },
                    pieSliceText: 'percentage',
                    chartArea: { 'width': '80%', 'height': '90%' }
                };

                var chart = new google.visualization.PieChart(document.getElementById(eleID));
                chart.draw(data, options);

                chart = new google.visualization.PieChart(document.getElementById(eleID + '_large'));
                chart.draw(data, options);

                toImg(eleID);
            }

            function toImg(chartContainer) {
                var gHidden = jQuery(".btn_graph_full[rel=" + chartContainer + "]").siblings("input[type='hidden']");
                gHidden.val(getImgData(chartContainer));
            }

            function getImgData(chartContainer) {
                var chartContainer = document.getElementById(eleID + '_large');

                var chartArea = chartContainer.getElementsByTagName('svg')[0].parentNode;
                var svg = chartArea.innerHTML;
                var doc = chartContainer.ownerDocument;
                var canvas = doc.createElement('canvas');
                canvas.setAttribute('width', chartArea.offsetWidth);
                canvas.setAttribute('height', chartArea.offsetHeight);
                canvas.setAttribute('style', 'position: absolute; ' + 'top: ' + (-chartArea.offsetHeight * 2) + 'px;' + 'left: ' + (-chartArea.offsetWidth * 2) + 'px;');
                doc.body.appendChild(canvas);
                canvg(canvas, svg);

                var imgData = canvas.toDataURL("image/png");
                canvas.parentNode.removeChild(canvas);
                return imgData;
            }


            }
            catch (err) {
                alert(err.message);
            }


        }
    </script>
</asp:Content>

<asp:Content ID="Content2" ContentPlaceHolderID="MainContent" Runat="Server">
    <article id="central">
        
<%--        <asp:UpdatePanel runat="server" ID="pnlSurveyResults" ChildrenAsTriggers="true">
            <ContentTemplate>--%>


        <header class="clearfix">
            <div class="hotel_title clearfix">
                <div class="ht_fullimg">
                    <asp:Image runat="server" ID="imgHeaderBannerFull" AlternateText="Survey Results Header" ImageUrl="/Media/Images/header-default.jpg" />
                </div>
            </div>

            <div class="survey_select left clearfix">
                <span class="ss_title">Survey Results Summary</span>
                <div class="ss_form_wrapper">
                    <fieldset class="ss_form site_form">
                        <legend>Surveys</legend>
                        <div class="ss_row">
                            <asp:Label runat="server" ID="lblSurveys" AssociatedControlID="ddlSurveys">Showing results for: </asp:Label>
                            <asp:DropDownList runat="server" ID="ddlSurveys" CssClass="ss_dd" />
                            <asp:Button runat="server" ID="btnSelectSurvey" Text="Select" CssClass="btn_site" />
                        </div>
                        <div class="ss_row">
                            <span class="ss_r_tip">Select from list above to view reports from your surveys</span>
                        </div>
                        <asp:PlaceHolder runat="server" ID="phSurveys" />
                    </fieldset>
                </div>
            </div>
        </header>
        <section>
            <asp:MultiView runat="server" ID="mvSurveyDetails" ActiveViewIndex="0">
                <asp:View runat="server" ID="NotLoadedView">
                    <div class="ar_content">
                        Select a survey from the above list.
                    </div>
                </asp:View>
                <asp:View runat="server" ID="CantLoadView">
                    <div class="ar_content">
                        There was a problem loading your survey. Please try again.
                    </div>
                </asp:View>
                <asp:View runat="server" ID="LoadedView">
                    
                    <div class="survey_summary clearfix">
                        <div class="ssum_info">
                            <h3 class="bold">Report View Export</h3>
                        </div>
                        <div class="ssum_fig">
                            <div class="ssum_f_col ssum_f_col_right">
                                <div class="ssum_f_opt">
                                    <asp:HyperLink runat="server" ID="lnkPDFExport" NavigateUrl="#" CssClass="btn_site btn_site_purple btn_reportexport">PDF</asp:HyperLink>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="survey_summary clearfix">
                        <div class="ssum_info">
                            <h3 class="bold">Report Summary and Options</h3>

                            <ul class="plainlist">
                                <li><span>Survey: </span><asp:Literal runat="server" ID="litSurveyTitle" /></li>
                                <li><span>Status: </span><asp:Literal runat="server" ID="litStatus" /></li>
                                <li><span>Created Time/Date: </span><asp:Literal runat="server" ID="litCreatedTimeDate" /></li>
                                <li><span>Modified Time/Date: </span><asp:Literal runat="server" ID="litModifiedTimeDate" /></li>
                            </ul>
                        </div>
                        <div class="ssum_fig">
                            <div class="ssum_f_col">
                                <div class="circ circ-f ssum_f_circ">
                                    <asp:Label runat="server" ID="lblTotalResponses" Text="0" />
                                </div>
                                <span class="lbl">Total Responses</span>
                                <div class="ssum_f_opt">
                                    <span class="lbl"><br />Set Filters</span>
                                    <a href="#" class="btn_site btn_filters">Set Filters</a>
                                </div>
                            </div>
                            <div class="ssum_f_col">
                                <div class="circ circ-e ssum_f_circ">
                                    <asp:Label runat="server" ID="lblFilteredResponses" Text="0" />
                                </div>
                                <span class="lbl">Filtered Responses</span>
                                <div class="ssum_f_opt">
                                    <span class="lbl">View <br />Individual Records</span>
                                    <asp:HyperLink runat="server" ID="lnkViewIndividualDetails" NavigateUrl="/surveys/single.aspx" CssClass="btn_site btn_responses">View Details</asp:HyperLink>
                                </div>
                            </div>
                            <div class="ssum_f_col">
                                <div class="circ circ-e ssum_f_circ">
                                    <asp:Label runat="server" ID="lblExcludedResponses" Text="0" />
                                </div>
                                <span class="lbl">Responses Excluded</span>
                                <div class="ssum_f_opt">
                                    <span class="lbl">Export <br />Full Report</span>
                                    <asp:HyperLink runat="server" ID="lnkExport" NavigateUrl="#" CssClass="btn_site btn_export">Export</asp:HyperLink>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="survey_qfilter clearfix">
                        <h3 class="bold">Question Filters and Cross Tabulation</h3>

                        <div class="s_qf_store clearfix">                        
                            <div class="s_qf_load">
                                <span class="title bold">Now Viewing</span>
                                <asp:DropDownList runat="server" ID="ddlQuestionFiltersSaved" CssClass="s_qf_dd" AutoPostBack="true" />
                            </div>

                            <div class="s_qf_save">
                                <fieldset class="qfs_form site_form">
                                    <legend>Surveys</legend>
                                    <div class="qfs_row">
                                        <span class="qfs_r_tip"></span>
                                    </div>
                                    <div class="qfs_row">
                                        <asp:TextBox runat="server" ID="txtQuestionFiltersSearch" CssClass="sf_row_text" />
                                        <asp:Button runat="server" ID="btnSaveQuestionFiltersSearch" CssClass="btn_site" Text="Save" OnCommand="QuestionFiltersSearch_Command" CommandName="save" />
                                        <span>&nbsp;or&nbsp;</span>
                                        <asp:Button runat="server" ID="btnDeleteQuestionFiltersSearch" CssClass="btn_site" Text="Delete" OnCommand="QuestionFiltersSearch_Command" CommandName="delete" />
                                        <span>&nbsp;or&nbsp;</span>
                                        <asp:Button runat="server" ID="btnClearQuestionFiltersSearch" CssClass="btn_site" Text="Clear" OnCommand="QuestionFiltersSearch_Command" CommandName="clear" />
                                    </div>
                                    <asp:PlaceHolder runat="server" ID="phQuestionFiltersSearch" />
                                </fieldset>
                            </div>    
                        </div>
                       
                        <asp:Panel runat="server" ID="pnlGlobalFiltersInfo" CssClass="s_qf_global clearfix">
                            <h3 class="bold">Meta Data Filters</h3>

                            <ul class="plainlist">
                                <li runat="server" ID="li_FilterInfoStatus" Visible="false">[<asp:Literal runat="server" ID="litFilterInfoStatus" /><span>: selected</span>]</li>
                                <li runat="server" ID="li_FilterInfoDateAfter" Visible="false">[<span>Responses Before: </span><asp:Literal runat="server" ID="litFilterInfoDateAfter" />]</li>
                                <li runat="server" ID="li_FilterInfoDateBefore" Visible="false">[<span>Responses After: </span><asp:Literal runat="server" ID="litFilterInfoDateBefore" />]</li>
                                <li runat="server" ID="li_FilterInfoAnswers" Visible="false">[<span>Answers containing: </span><asp:Literal runat="server" ID="litFilterInfoAnswers" />]</li>
                            </ul>
                        </asp:Panel>

                        <table cellspacing="0" cellpadding="0" class="s_qf_list">
                            <tr class="s_qf_l_headers">
                                <th class="s_qf_l_c_delete"><span class="s_qf_l_title bold">Delete</span></th>
                                <th class="s_qf_l_c_active"><span class="s_qf_l_title bold">Active</span></th>
                                <th class="s_qf_l_c_filter"><span class="s_qf_l_title bold">Filter</span></th>
                            </tr>

                            <asp:ListView runat="server" ID="lvQuestionFilters" ItemPlaceholderID="phQuestionFilter">
                                <LayoutTemplate>
                                    <asp:PlaceHolder runat="server" ID="phQuestionFilter" />
                                </LayoutTemplate>
                                <ItemTemplate>
                                    <tr class="s_qf_l_item">
                                        <td class="s_qf_l_c_delete">
                                            <asp:CheckBox runat="server" ID="chkDelete" />
                                        </td>
                                        <td class="s_qf_l_c_active">
                                            <asp:CheckBox runat="server" ID="chkActive" />
                                        </td>
                                        <td class="s_qf_l_c_filter">
                                            <%# "QUESTION " & Eval("QuestionIndex") & ": " & Eval("QuestionTitle") & " -  ANSWER: " & Eval("QuestionOptionTitle")%>
                                            <asp:HiddenField runat="server" ID="hdnQuestionFilterValue" Value='<%# Eval("FieldValue") %>' />
                                        </td>
                                    </tr>
                                </ItemTemplate>
                                <EmptyDataTemplate>
                                    <tr class="s_qf_l_item">
                                        <td class="s_qf_l_c_delete">
                                            -
                                        </td>
                                        <td class="s_qf_l_c_active">
                                            -
                                        </td>
                                        <td class="s_qf_l_c_filter">
                                            None set
                                        </td>
                                    </tr>
                                </EmptyDataTemplate>
                            </asp:ListView>

                            <tr runat="server" id="tr_filtertype_and" visible="false" class="s_qf_l_item">
                                <td class="s_qf_l_c_delete">
                                    <asp:RadioButton runat="server" ID="rbAndFilter" GroupName="rbQuestionFilterType" />
                                </td>
                                <td class="s_qf_l_c_active">
                                    Match all filters (AND)
                                </td>
                                <td class="s_qf_l_c_filter">&nbsp;</td>
                            </tr>
                            <tr runat="server" id="tr_filtertype_or" visible="false" class="s_qf_l_item">
                                <td class="s_qf_l_c_delete">
                                    <asp:RadioButton runat="server" ID="rbOrFilter" Checked="true" GroupName="rbQuestionFilterType" />
                                </td>
                                <td class="s_qf_l_c_active">
                                    Match any filter (OR)
                                </td>
                                <td class="s_qf_l_c_filter">
                                    <asp:Button runat="server" ID="btnUpdateQuestionFilters" CssClass="btn_site" Text="Update Filters" />
                                </td>
                            </tr>

                        </table>

                        <div class="s_qf_opts"></div>
                    </div>
                    <span class="pagebreak"></span>
                    
                    <asp:MultiView runat="server" ID="mvResponseList" ActiveViewIndex="0">
                        <asp:View runat="server" ID="ResponseView">
                            <asp:ListView runat="server" ID="lvSurveyQuestions">
                                <ItemTemplate>
                                    <PM:SurveyQuestion runat="server" ID="pmSurveyQuestion" OnFilterClicked="lvSurveyQuestions_OnFilterClicked" />
                                    <asp:HiddenField runat="server" ID="hdnSQ" />
                                    <span class="pagebreak"></span>
                                </ItemTemplate>
                                <EmptyDataTemplate>
                                    No data found
                                </EmptyDataTemplate>
                            </asp:ListView>
                        </asp:View>
                        <asp:View runat="server" ID="HiddenResponseView">
                            Not enough data for responses to be shown.
                        </asp:View>
                    </asp:MultiView>

                </asp:View>
            </asp:MultiView>
        </section>

    <asp:Panel runat="server" ID="pnlSurveyFiltering" CssClass="s_modal s_modal_filter">
        <div class="s_modal_inner">
            <span class="title clearfix">Global Survey Filters</span>
            
            <div class="s_modal_text clearfix">
                You can use the options below to set filters on the result sets for your survey.
            </div>

            <div class="s_modal_body clearfix">
                <div class="s_m_col">
                    <span class="subtitle bold">Fully completed or part-completed surveys</span>
                    <div class="s_m_col_body clearfix">
                        <asp:RadioButtonList runat="server" ID="rblSurveyStatus" CssClass="s_m_col_list s_m_col_rbl plainlist clearfix" RepeatLayout="UnorderedList">
                            <asp:ListItem Value="both" Selected="True">Show all results (both fully completed surveys and part-completed surveys)</asp:ListItem>
                            <asp:ListItem Value="complete">Show ONLY FULLY COMPLETED surveys</asp:ListItem>
                            <asp:ListItem Value="partial">Show ONLY PART-COMPLETED surveys</asp:ListItem>
                        </asp:RadioButtonList>
                    </div>
                </div>
                <div class="s_m_col">
                    <span class="subtitle bold">Filter results by dates</span>
                    <div class="s_m_col_body clearfix">
                        <ul class="s_m_col_list s_m_col_date plainlist">
	                        <li>
                                Exclude results AFTER:
                                <asp:TextBox runat="server" ID="txtDateAfter" CssClass="s_m_d s_m_d_after s_m_col_txt" />
	                        </li>
	                        <li>
                                Exclude results BEFORE:
                                <asp:TextBox runat="server" ID="txtDateBefore" CssClass="s_m_d s_m_d_before s_m_col_txt" />
	                        </li>
                        </ul>
                    </div>
                </div>
                <div class="s_m_col s_m_col_end">
                    <span class="subtitle bold">Filter results by custom data</span>
                    <div class="s_m_col_body clearfix">
                        <ul class="s_m_col_list s_m_col_data plainlist">
	                        <li>
                                Show only data for respondents whose custom data field contains this text:
                                <asp:TextBox runat="server" ID="txtData" CssClass="s_m_col_txt" />
	                        </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <asp:Button runat="server" ID="btnSurveyFiltering" Text="Save" CssClass="btn_site s_modal_save" />
            <a href="#" class="btn_site s_modal_close s_modal_filter_close">Close</a>

        </div>
    </asp:Panel>
    <asp:Panel runat="server" ID="pnlSurveyExport" CssClass="s_modal s_modal_export">
        <div class="s_modal_inner">
            <span class="title clearfix">Export</span>
            
            <div class="s_modal_text clearfix">
                Export your results to various formats.
            </div>

            <div class="s_modal_body clearfix">
                <div class="s_m_col">
                    <span class="subtitle bold">Plain Results</span>                    
                    <div class="s_m_col_body clearfix">
                        <ul class="s_m_col_list s_m_col_exportfilters plainlist">
                            <li>
                                All results for all questions in a single file with associated text results placed after the aggregate results for each question.                                
                            </li>
	                        <li>
                                <asp:CheckBox runat="server" ID="chkExportPlainResults" Text="Single File (check box if required)" TextAlign="Right" Checked="true" />
	                        </li>
                        </ul>
                    </div>
                </div>
                <div class="s_m_col">
                    <span class="subtitle bold">Raw Data Results</span>                    
                    <div class="s_m_col_body clearfix">
                        <ul class="s_m_col_list s_m_col_exportfilters plainlist">
                            <li>
                                Export the raw response data for the current list of responses.
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="s_m_col s_m_col_end">
                    <span class="subtitle">Your results will be exported in a .csv (comma separated values) file format. This file format can be read by most text editors (eg. Notepad, WordPad), spreadsheets (eg Microsoft Excel) and analysis applications (eg.SPSS).</span>
                    <div class="s_m_col_body clearfix"></div>
                </div>
            </div>
            
            <div class="s_modal_body s_modal_body_msg red clearfix">
                <asp:Literal runat="server" ID="litExportMsg" />
            </div>
            
            <asp:Button runat="server" ID="btnSurveyExport" Text="Export" CssClass="btn_site s_modal_save s_modal_plain" />
            <asp:Button runat="server" ID="btnRawExport" Text="Export" CssClass="btn_site s_modal_save s_modal_raw" />
            <a href="#" class="btn_site s_modal_close s_modal_export_close">Close</a>

        </div>
    </asp:Panel>

    <asp:Panel runat="server" ID="pnlExportOptions" CssClass="s_modal s_modal_reportexport">
        <div class="s_modal_inner">
            <span class="title clearfix">Report Export Options</span>
            
            <div class="s_modal_text clearfix">
                Export your results.
            </div>

            <div class="s_modal_body clearfix">
                <div class="s_m_col s_m_col_end">
                    <span class="subtitle bold">PDF Results</span>                    
                    <div class="s_m_col_body clearfix">
                        <ul class="s_m_col_list s_m_col_exportfilters plainlist">
                            <li>
                                All results for all questions in a single PDF file with associated text results placed after the aggregate results for each question.                                
                            </li>
	                        <li>
                                <asp:CheckBox runat="server" ID="chkExportIncludeComments" Text="Include comments (check box if required)" TextAlign="Right" Checked="true" />
	                        </li>
                        </ul>
                    </div>
                </div>
            <%--<div class="s_m_col">
                    <span class="subtitle bold"></span>  
                    <div class="s_m_col_body clearfix"></div>
                </div>
                <div class="s_m_col s_m_col_end">
                    <span class="subtitle">Your results will be exported as a .PDF document.</span>
                    <div class="s_m_col_body clearfix"></div>
                </div>--%>
            </div>
            
            <div class="s_modal_body s_modal_body_msg red clearfix">
                <asp:Literal runat="server" ID="litReportExportMsg" />
            </div>
            
            
            <asp:LinkButton runat="server" ID="btnExportPDF" OnClientClick="toImg(document.getElementById('pie_div'), document.getElementById('img_div'));" CssClass="btn_site s_modal_save ">Export PDF</asp:LinkButton>

            <a href="#" class="btn_site s_modal_close s_modal_reportexport_close">Close</a>

        </div>
    </asp:Panel>

<%--         http://www.aspdotnet-suresh.com/2013/10/jQuery-display-Progress-Bar-on-Button-Click-in-Aspnet.html               <asp:UpdateProgress ID="upSurveyResults" runat="server" AssociatedUpdatePanelID="pnlSurveyResults">
                            <ProgressTemplate>
                                <div class="loading_overlay"><div class="loading"></div></div>
                            </ProgressTemplate>
                        </asp:UpdateProgress>
        </ContentTemplate>
    </asp:UpdatePanel>--%>
    </article>

</asp:Content>

<asp:Content ID="Content3" ContentPlaceHolderID="ScriptContent" Runat="Server">
    <script type="text/javascript" src="https://secureping.co.uk/safe/scripts/libs/jquery-ui-timepicker-addon.js"></script>

    <script type="text/javascript">

        jQuery(document).ready(function () {
            LoadPage();
        });

        function LoadPage() {
            jQuery(".btn_filters").click(function () {
                jQuery(".s_modal_filter").fadeIn();
                jQuery(".s_m_d").datetimepicker({ dateFormat: 'dd/mm/yy', });
                return false;
            });

            jQuery(".btn_export").click(function () {
                jQuery(".s_modal_export").fadeIn();
                return false;
            });

            jQuery(".btn_reportexport").click(function () {
                jQuery(".s_modal_reportexport").fadeIn();
                return false;
            });

            jQuery(".s_modal_close").click(function () {
                jQuery(".s_modal_filter").fadeOut();
                jQuery(".s_modal_export").fadeOut();
                jQuery(".s_modal_reportexport").fadeOut();
                return false;
            });

            jQuery(".s_modal_view").click(function () {
                var qid = jQuery(this).attr("rel");

                jQuery(".si_modal_textvalues").fadeOut();
                jQuery(".si_modal_textvalues_" + qid).fadeIn();
                //return false;
            });

            jQuery(".s_modal_textvalues_close").click(function () {
                jQuery(".si_modal_textvalues").fadeOut();
                return false;
            });
        }

        function OpenResponsesWindow(sq, so) {
            alert("boo");
            if (so > 0) {
                window.open('/surveys/text-details.aspx?sq=' + sq + '&so=' + so, '', 'width=500, height=600');
            }
            else {
                window.open('/surveys/text-details.aspx?sq=' + sq, '', 'width=500, height=600');
            }

            myWindow.focus();

            return false;
        }

        function toImg(chartContainer, imgContainer) { 
            var doc = chartContainer.ownerDocument;
            var img = doc.createElement('img');
            img.src = getImgData(chartContainer);
        
            while (imgContainer.firstChild) {
                imgContainer.removeChild(imgContainer.firstChild);
            }
            imgContainer.appendChild(img);
        }

        function getImgData(chartContainer) {
            var chartArea = chartContainer.getElementsByTagName('svg')[0].parentNode;
            var svg = chartArea.innerHTML;
            var doc = chartContainer.ownerDocument;
            var canvas = doc.createElement('canvas');
            canvas.setAttribute('width', chartArea.offsetWidth);
            canvas.setAttribute('height', chartArea.offsetHeight);
            canvas.setAttribute('style', 'position: absolute; ' + 'top: ' + (-chartArea.offsetHeight * 2) + 'px;' + 'left: ' + (-chartArea.offsetWidth * 2) + 'px;');
            doc.body.appendChild(canvas);
            canvg(canvas, svg);
            
            var imgData = canvas.toDataURL("image/png");
            canvas.parentNode.removeChild(canvas);
            return imgData;
        }

        function toImg(chartContainer, imgContainer) {
            var save_link = jQuery("#save_link");
            save_link.attr("href", getImgData(chartContainer));
            save_link.attr("download", "chart_download_" + QuestionID + ".png");

            jQuery('#g_i_graph_img').attr("src", getImgData(chartContainer));
            jQuery('#g_i_graph_img').show();
            jQuery('#ctl00_MainContent_blgraph_wrapper').hide();
            jQuery('.loading_overlay').hide();
        }

    </script>
</asp:Content>
