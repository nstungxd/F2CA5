<%@ Page Title="" Language="VB" MasterPageFile="~/Site.master" AutoEventWireup="false" CodeFile="single.aspx.vb" Inherits="Surveys_single" %>

<asp:Content ID="Content1" ContentPlaceHolderID="HeadContent" Runat="Server">
    <link href="/Media/Styles/redmond.jquery-ui.css" rel="stylesheet" />
</asp:Content>
<asp:Content ID="Content2" ContentPlaceHolderID="MainContent" Runat="Server">
    <article id="central">
        <header class="clearfix">
            <div class="hotel_title clearfix">
                <div class="ht_fullimg">
                    <asp:Image runat="server" ID="imgHeaderBannerFull" AlternateText="Survey Results Header" ImageUrl="/Media/Images/header-default.jpg" />
                </div>
            </div>
            
            <div class="surveydetails_select left clearfix">
                <span class="sd_title">Survey Results Detailed</span>
                <div class="sd_form_wrapper">
                    <fieldset class="sd_form site_form">
                        <legend>Back to results</legend>
                        <div class="sd_row clearfix">
                            <asp:HyperLink runat="server" ID="lnkBackToResults" NavigateUrl="/surveys" CssClass="btn_site">Back</asp:HyperLink>
                            <span>Go back to Results Summary</span>
                        </div>
                    </fieldset>
                </div>
            </div>
        </header>
        <section>
            
            <div class="surveydetails_opts clearfix">
                <div class="sd_o_col sd_o_col_one">
                    <div class="sd_o_pg clearfix">
                       <span class="sd_o_pg_lbl sd_o_pg_title">You are currently viewing record:</span>

                        <asp:Panel runat="server" ID="pnlSurveyResponses" CssClass="sd_o_pg_pg">
                            <asp:DataPager runat="server" PageSize="1" ID="dpSurveyResponses" PagedControlID="lvSurveyResponses" QueryStringField="p">
                                <Fields>
                                    <asp:NextPreviousPagerField ShowNextPageButton="false" ShowPreviousPageButton="true" ButtonCssClass="sd_o_pg_b sd_o_pg_b_prv ir" ButtonType="Link" PreviousPageText="Prev" />
                                    <asp:TemplatePagerField>
                                        <PagerTemplate>
                                            <span class="sd_o_pg_lbl sd_o_pg_curr bold">
                                                <%# IIf(Container.TotalRowCount>0,  (Container.StartRowIndex / Container.PageSize) + 1 , 0) %>
                                            </span>
                                        </PagerTemplate>
                                    </asp:TemplatePagerField>
                                    <asp:NextPreviousPagerField ShowNextPageButton="true" ShowPreviousPageButton="false" ButtonCssClass="sd_o_pg_b sd_o_pg_b_nxt ir" ButtonType="Link" PreviousPageText="Next" />
                                    <asp:TemplatePagerField>
                                        <PagerTemplate>
                                            <span class="sd_o_pg_lbl sd_o_pg_tot bold">
                                                <%# Math.Ceiling (System.Convert.ToDouble(Container.TotalRowCount) / Container.PageSize) %>
                                            </span>
                                        </PagerTemplate>
                                    </asp:TemplatePagerField>
                                </Fields>
                            </asp:DataPager>
                        </asp:Panel>
                    </div>
                    <asp:Panel runat="server" ID="pnlDetails" CssClass="srdetails_summary clearfix" Visible="false">
                        <div class="srdsum_info">
                            <h3 class="bold">Respondent details:</h3>

                            <ul class="plainlist">
                                <li><span>Fully completed?: </span><asp:Literal runat="server" ID="litResponseDetailsCompleted" /></li>
                                <li><span>Date completed/last update: </span><asp:Literal runat="server" ID="litResponseDetailsDate" /></li>
                                <li><span>Response ID: </span><asp:Literal runat="server" ID="litResponseDetailsID" /></li>
                                <li>
                                    <asp:CheckBox runat="server" ID="chkExcludeFromExport" Text="Exclude from PDF Report?" AutoPostBack="true" />
                                </li>
                            </ul>
                        </div>
                        <div class="srdsum_add"></div>
                    </asp:Panel>
                </div>
                <div class="sd_o_col sd_o_col_two">
                    <div class="sd_o_jump clearfix">
                        <div class="sd_o_jump_form_wrapper">
                            <fieldset class="sd_o_jump_form site_form">
                                <legend>Record Jump</legend>
                                <div class="sd_o_jump_row clearfix">
                                    <asp:Label runat="server" ID="lblSearchRecordJump" AssociatedControlID="txtSearchRecordJump">Go to Result Set:</asp:Label>
                                    <asp:TextBox runat="server" ID="txtSearchRecordJump" CssClass="sf_row_text" />
                                    <asp:Button runat="server" ID="btnSearchRecordJump" Text="Search" CssClass="btn_site" />
                                </div>
                                <asp:PlaceHolder runat="server" ID="phSearchRecordJump" />
                            </fieldset>
                        </div>
                    </div>
                    <div class="sd_o_sid clearfix">
                        <div class="sd_o_sid_form_wrapper">
                            <fieldset class="sd_o_sid_form site_form">
                                <legend>Response ID Search</legend>
                                <div class="sd_o_sid_row clearfix">
                                    <asp:Label runat="server" ID="lblSearchRecordID" AssociatedControlID="txtSearchRecordID">Enter Response ID: </asp:Label>
                                    <asp:TextBox runat="server" ID="txtSearchRecordID" CssClass="sf_row_text" />
                                    <asp:Button runat="server" ID="btnSearchRecordID" Text="View" CssClass="btn_site" />
                                </div>
                                <asp:PlaceHolder runat="server" ID="phSearchRecordID" />
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>

            <asp:MultiView runat="server" ID="mvSurveyDetails" ActiveViewIndex="0">
                <asp:View runat="server" ID="NotLoadedView">
                    <p>
                        No response loaded. Please refresh the page or <a href="/surveys">click here to try again</a>.
                    </p>
                </asp:View>
                <asp:View runat="server" ID="CantLoadView">
                    <p>
                        There was a problem loading the response information. <a href="/surveys">Please click here to try again</a>.
                    </p>
                </asp:View>
                <asp:View runat="server" ID="LoadedView">
                    <div class="srquestion_nav clearfix">
                        <h3 class="bold clearfix">Survey Navigator: Select the question to view:</h3>
                        <div class="srq_nav_form_wrapper">
                            <fieldset class="srq_nav_form site_form">
                                <legend>Select question</legend>
                                <div class="srq_nav_row clearfix">
                                    <asp:DropDownList runat="server" ID="ddlResponseQuestions" CssClass="srq_nav_dd" AutoPostBack="true" />
                                </div>
                            </fieldset>
                        </div>
                        <div class="srquestion_print">
                            <asp:Button runat="server" ID="btnDownloadResults" CssClass="btn_site btn_site_lngtxt" Text="Download/Print" />
                            <asp:PlaceHolder runat="server" ID="phDownloadResults" />
                        </div>
                    </div>
                    
                    <div class="srquestion_list clearfix">
                        <asp:ListView runat="server" ID="lvSurveyResponses">
                            <ItemTemplate>
                                <asp:Repeater runat="server" ID="rptQuestions" OnItemDataBound="rptQuestions_ItemDataBound">
                                    <ItemTemplate>
                                        <PM:SurveyQuestionDetails runat="server" ID="pmSurveyQuestionDetails" />
                                    </ItemTemplate>
                                </asp:Repeater>
                            </ItemTemplate>
                            <EmptyDataTemplate>
                                No data found
                            </EmptyDataTemplate>
                        </asp:ListView>
                    </div>
                </asp:View>
            </asp:MultiView>
        </section>
    </article>
</asp:Content>


