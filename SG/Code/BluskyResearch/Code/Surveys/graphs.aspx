<%@ Page Title="" Language="VB" MasterPageFile="~/Site.master" AutoEventWireup="false" CodeFile="graphs.aspx.vb" Inherits="Surveys_graphs" %>

<asp:Content ID="Content1" ContentPlaceHolderID="HeadContent" Runat="Server">
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="http://canvg.googlecode.com/svn/trunk/rgbcolor.js"></script>
    <script type="text/javascript" src="http://canvg.googlecode.com/svn/trunk/canvg.js"></script>

    <script type="text/javascript">
        function LoadPieChart(eleID, resultArray, title, tooltip, slicetext) {
            google.load("visualization", "1", { packages: ["corechart"] });
            google.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable(resultArray);

                var options = {
                    title: title,
                    colors: ['#008BD2', '#DC3912', '#FFCD00', '#10B618', '#994499', '#0099C6', '#B82E2E', '#316395', '#66AA00', '#DD4477', '#BBCCED', '#80C65A', '#FF0000', '#16c78e', '#0e6e82', '#b39700'],
                    tooltip: { text: tooltip },
                    pieSliceText: slicetext
                };

                var chart = new google.visualization.PieChart(document.getElementById(eleID));
                chart.draw(data, options);
            }
        }

        function LoadColumnChart(eleID, resultArray, title, vAxisTitle, hAxisTitle) {
            google.load("visualization", "1", { packages: ["corechart"] });
            google.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable(resultArray);

                var options = {
                    title: title,
                    colors: ['#008BD2', '#DC3912', '#FFCD00', '#10B618', '#994499', '#0099C6', '#B82E2E', '#316395', '#66AA00', '#DD4477', '#BBCCED', '#80C65A', '#FF0000', '#16c78e', '#0e6e82', '#b39700'],
                    tooltip: { text: 'value' },
                    hAxis: { title: hAxisTitle },
                    vAxis: { title: vAxisTitle },
                    legend: 'none'
                };

                var chart = new google.visualization.ColumnChart(document.getElementById(eleID));
                chart.draw(data, options); 
            }
        }

        function LoadBarChart(eleID, resultArray, title, vAxisTitle, hAxisTitle) {
            google.load("visualization", "1", { packages: ["corechart"] });
            google.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable(resultArray);

                var options = {
                    title: title,
                    colors: ['#008BD2', '#DC3912', '#FFCD00', '#10B618', '#994499', '#0099C6', '#B82E2E', '#316395', '#66AA00', '#DD4477', '#BBCCED', '#80C65A', '#FF0000', '#16c78e', '#0e6e82', '#b39700'],
                    tooltip: { text: 'value' },
                    vAxis: { title: vAxisTitle },
                    hAxis: { title: hAxisTitle },
                    legend: 'none'
                };

                var chart = new google.visualization.BarChart(document.getElementById(eleID));
                chart.draw(data, options);
            }
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

        function disableLink(e) {
            // cancels the event
            e.preventDefault();
            return false;
        }

        jQuery(document).ready(function () { 

            // Disable link
            jQuery('#save_link').bind('click', disableLink);

            setTimeout(function () {
                // Set link
                toImg(document.getElementById('blgraph'), document.getElementById('img_div'));
                // enable link
                jQuery('#save_link').unbind('click', disableLink);
            }, 3000);
        });

    </script>

</asp:Content>

<asp:Content ID="Content2" ContentPlaceHolderID="MainContent" Runat="Server">
    <article id="central">
        <header class="clearfix">
            <div class="hotel_title clearfix">
                <div class="ht_fullimg">
                    <asp:Image runat="server" ID="imgHeaderBannerFull" AlternateText="Survey Results Header" ImageUrl="/Media/Images/header-default.jpg" />
                </div>
            </div>
        </header>
        <section>

        <div class="survey_summary clearfix">
                <div class="ssum_info ssum_info_g clearfix">
                    <h3 class="bold btn_graph_full">View and download graphs</h3>
                    <a href="/surveys/" title="Back to results" class="btn_site">Back</a>
                </div>

                <div class="graph_summary clearfix">
                    <div class="gsum_info">
                        <asp:Label runat="server" ID="lblQuestionTitle" CssClass="bold" />
                    </div>
                    <div class="gsum_opt">
                        <div class="gs_form_wrapper">
                            <fieldset class="gs_form site_form">
                                <legend>Questions</legend>
                                <div class="gs_row">
                                    <asp:Label runat="server" ID="lblQuestions" AssociatedControlID="ddlQuestions">Change Question</asp:Label>
                                </div>
                                <div class="gs_row">
                                    <asp:DropDownList runat="server" ID="ddlQuestions" CssClass="gs_dd" />
                                    <asp:Button runat="server" ID="btnChangeQuestion" Text="Change" CssClass="btn_site" />
                                </div>
                                <asp:PlaceHolder runat="server" ID="phQuestions" />
                            </fieldset>
                        </div>

                    </div>
                </div>
            </div>

            <asp:MultiView runat="server" ID="mvQuestionDetails" ActiveViewIndex="0">
                <asp:View runat="server" ID="NotLoadedView">
                    <div class="graph_select">
                        <p>
                            There was a problem loading the survey information. <a href="/surveys">Please click here to try again</a>.
                        </p>
                    </div>
                </asp:View>
                <asp:View runat="server" ID="LoadedView">
                    <div class="graph_select">
                        <span class="title">Select type of chart:</span>
                        <div class="g_s_opts clearfix">
                            <div class="g_s_opt">
                                <asp:LinkButton runat="server" ID="lnkBarChart" CssClass="g_s_opt_bar">Bar Chart</asp:LinkButton>
                            </div>
                            <div class="g_s_opt">
                                <asp:LinkButton runat="server" ID="lnkPieChart" CssClass="g_s_opt_pie">Pie Chart</asp:LinkButton>
                            </div>
                            <div class="g_s_opt g_i_opts">
                                <asp:Label runat="server" ID="lblTypeTitle" CssClass="title bold" Text="Bar Chart" />
                                <asp:Panel runat="server" ID="pnlChartDirection" CssClass="g_i_o_dir" Visible="false">
                                    <asp:Label runat="server" ID="lblChartDirection" AssociatedControlID="ddlChartDirection" CssClass="g_i_o_lbl">View bar chart as</asp:Label>
                                    <asp:DropDownList runat="server" ID="ddlChartDirection" CssClass="g_i_o_dd" AutoPostBack="true">
                                        <asp:ListItem Value="vertical" Selected="True">Vertical</asp:ListItem>
                                        <asp:ListItem Value="horizontal">Horizontal</asp:ListItem>
                                    </asp:DropDownList>
                                </asp:Panel>
                                <asp:Panel runat="server" ID="pnlChartDataView" CssClass="g_i_o_dir" Visible="true">
                                    <asp:Label runat="server" ID="lblChartDataView" AssociatedControlID="ddlChartDataView" CssClass="g_i_o_lbl">View in</asp:Label>
                                    <asp:DropDownList runat="server" ID="ddlChartDataView" CssClass="g_i_o_dd" AutoPostBack="true">
                                        <asp:ListItem Value="percentages" Selected="True">Percentages</asp:ListItem>
                                        <asp:ListItem Value="values">Values</asp:ListItem>
                                    </asp:DropDownList>
                                </asp:Panel>
                            </div>
                        </div>
                    </div>
            
                    <div class="graph_item clearfix">
                        <div class="g_i_graph">
                            <img alt="Graph" id="g_i_graph_img" style="display:none;" />
                            <asp:PlaceHolder runat="server" ID="phGraph" />
                            <div class="loading_overlay"><div class="loading"></div></div>
                        </div>
                    </div>
                    
                    <div class="g_link clearfix">
                        <a href="#" id="save_link" target="_blank" class="btn_site">Save</a>
                        <span class="tooltip">Click to save the chart as an image</span>
                    </div>

                </asp:View>
            </asp:MultiView>
        </section>
    </article>
</asp:Content>


