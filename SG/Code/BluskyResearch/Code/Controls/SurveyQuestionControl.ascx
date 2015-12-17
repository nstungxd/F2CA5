<%@ Control Language="VB" AutoEventWireup="false" CodeFile="SurveyQuestionControl.ascx.vb" Inherits="Controls_SurveyQuestionControl" %>
<%--<%@ Register TagPrefix="PM" Src="~/Controls/SurveyQuestionControl.ascx" TagName="SurveySubQuestion" %>--%>

    <asp:MultiView runat="server" ID="mvSurveyQuestionDetails" ActiveViewIndex="0">
        <asp:View runat="server" ID="LoadedView">

            <div runat="server" id="si_item" class="survey_item clearfix">
                                
                <div class="si_title clearfix">
                   <asp:Literal runat="server" ID="litQuestionTitle" />
                </div>

                <div runat="server" id="si_dataitem" class="si_data">

                    <asp:MultiView runat="server" ID="mvQuestion" ActiveViewIndex="0">
                        <asp:View runat="server" ID="TextView">
                            <div runat="server" ID="div_text_values" class="si_values">
                                <asp:Panel runat="server" ID="pnlTextViewButton" CssClass="si_row si_row_data">
                                    <asp:HyperLink runat="server" ID="btnTextViewButton" CssClass="btn_site s_modal_view">View Responses</asp:HyperLink>
                                </asp:Panel>
                            </div>
                        </asp:View>
                        <asp:View runat="server" ID="TableView">
                            <div class="si_values">
                                <div class="si_row si_row_plain">
                                    <div class="si_row_item si_item_left">Answers:</div>
                                </div>
                                <div class="si_row si_row_header">
                                    <div class="si_row_header_wrapper">
                                        <asp:Repeater runat="server" ID="rptTableSubQuestionAnswers" OnItemDataBound="TableSubQuestionAnswersRepeaterItemDataBound">
                                            <ItemTemplate>
                                                <div runat="server" id="si_row_header_item" class="si_row_header_item">
                                                    <span><%# Eval("Title")%></span>
                                                </div>    
                                            </ItemTemplate>
                                        </asp:Repeater>
                                    </div>
                                    <div class="si_row_header_item si_row_header_item_start"><span>Total Responses</span></div>
                                    <div class="si_row_header_item"><span>Not Answered</span></div>
                                    <div class="si_row_header_item si_row_header_graph"><span>View Graphs</span></div>
                                </div>
                                <asp:Repeater runat="server" ID="rptTableSubQuestions" OnItemDataBound="SubQuestionsRepeaterItemDataBound">
                                    <ItemTemplate>    
                                        <div class="si_row si_row_data">
                                            <div class="si_row_item si_item_left"><%# Eval("Title")%></div>
                                            <div class="si_row_data_wrapper">
                                                <asp:Repeater runat="server" ID="rptTableSubQuestionResults" OnItemDataBound="TableSubQuestionResultsRepeaterItemDataBound">
                                                    <ItemTemplate>    
                                                        <div runat="server" id="si_row_data_item" class="si_row si_row_data">
                                                            <asp:LinkButton runat="server" ID="lnkSetAnswerFilter" OnCommand="SetAnswerFilter" CommandName='<%# CurrentSurveyQuestion.SubType %>' CssClass="si_row_data_filter" ToolTip="Filter all results by this answer">                                                    
                                                                <asp:Label runat="server" ID="lblResult" CssClass="si_row_data_count" Text="0" />
                                                            </asp:LinkButton>
                                                        </div>
                                                    </ItemTemplate>
                                                </asp:Repeater>
                                            </div>
                                            <div class="si_row_total si_row_total_start"><asp:Label runat="server" ID="lblTotalResponses" Text="0" /></div>
                                            <div class="si_row_total"><asp:Label runat="server" ID="lblNotAnswered" Text="0" /></div>
                                            <div class="si_row_total si_row_total_graph">
                                                <asp:HyperLink runat="server" ID="lnkViewGraphs" CssClass="ir btn_graph" Target="_blank" NavigateUrl='<%# GetGraphLink(Eval("ID"))%>'>View Graphs</asp:HyperLink>
                                            </div>
                                        </div>
                                    </ItemTemplate>
                                    <AlternatingItemTemplate>    
                                        <div class="si_row si_row_alt si_row_data">
                                            <div class="si_row_item si_item_left"><%# Eval("Title")%></div>
                                            <div class="si_row_data_wrapper">
                                                <asp:Repeater runat="server" ID="rptTableSubQuestionResults" OnItemDataBound="TableSubQuestionResultsRepeaterItemDataBound">
                                                    <ItemTemplate>    
                                                        <div runat="server" id="si_row_data_item" class="si_row si_row_data">
                                                            <asp:LinkButton runat="server" ID="lnkSetAnswerFilter" OnCommand="SetAnswerFilter" CommandName='<%# CurrentSurveyQuestion.SubType %>' CssClass="si_row_data_filter" ToolTip="Filter all results by this answer">                                                    
                                                                <asp:Label runat="server" ID="lblResult" CssClass="si_row_data_count" Text="0" />
                                                            </asp:LinkButton>
                                                        </div>
                                                    </ItemTemplate>
                                                </asp:Repeater>
                                            </div>
                                            <div class="si_row_total si_row_total_start"><asp:Label runat="server" ID="lblTotalResponses" Text="0" /></div>
                                            <div class="si_row_total"><asp:Label runat="server" ID="lblNotAnswered" Text="0" /></div>
                                            <div class="si_row_total si_row_total_graph">
                                                <asp:HyperLink runat="server" ID="lnkViewGraphs" CssClass="ir btn_graph" Target="_blank" NavigateUrl='<%# GetGraphLink(Eval("ID"))%>'>View Graphs</asp:HyperLink>
                                            </div>
                                        </div>
                                    </AlternatingItemTemplate>
                                </asp:Repeater>
                            </div>
                        </asp:View>
                        <asp:View runat="server" ID="RadioView">
                            <div class="si_values">
                                <asp:Repeater runat="server" ID="rptRadioOptions" OnItemDataBound="OptionsRepeaterItemDataBound">
                                    <HeaderTemplate>
                                        <div class="si_row si_row_plain">
                                            <div class="si_row_item si_item_left">Answers:</div>
                                            <div class="si_row_item si_item_right">Responses:</div>
                                        </div>
                                    </HeaderTemplate>
                                    <ItemTemplate>    
                                        <div class='<%# "si_row si_row_data si_row_" & container.ItemIndex %>'>
                                            <div class="si_row_item si_item_left"><%# Eval("Title") %></div>
                                            <div class="si_row_data si_item_left">
                                                <asp:LinkButton runat="server" ID="lnkSetAnswerFilter" OnCommand="SetAnswerFilter" CommandName='<%# CurrentSurveyQuestion.SubType %>' CssClass="si_row_data_filter" ToolTip="Filter all results by this answer">
                                                    <asp:Label runat="server" ID="lblAmountFilled" CssClass="si_row_data_fill" Style="width:0px;" />
                                                    <asp:Label runat="server" ID="lblResult" CssClass="si_row_data_count" Text="0 / 0%" />
                                                </asp:LinkButton>
                                            </div>
                                        </div>
                                    </ItemTemplate>
                                    <AlternatingItemTemplate>    
                                        <div class='<%# "si_row si_row_data si_row_alt si_row_" & Container.ItemIndex%>'>
                                            <div class="si_row_item si_item_left"><%# Eval("Title") %></div>
                                            <div class="si_row_data si_item_left">
                                                <asp:LinkButton runat="server" ID="lnkSetAnswerFilter" OnCommand="SetAnswerFilter" CommandName='<%# CurrentSurveyQuestion.SubType %>' CssClass="si_row_data_filter" ToolTip="Filter all results by this answer">
                                                    <asp:Label runat="server" ID="lblAmountFilled" CssClass="si_row_data_fill" Style="width:0px;" />
                                                    <asp:Label runat="server" ID="lblResult" CssClass="si_row_data_count" Text="0 / 0%" />
                                                </asp:LinkButton>
                                            </div>
                                        </div>
                                    </AlternatingItemTemplate>
                                </asp:Repeater>

                                <asp:Panel runat="server" ID="pnlTextViewButtonRadio" CssClass="si_row si_row_data si_row_view">
                                    <asp:HyperLink runat="server" ID="btnTextViewButtonRadio" CssClass="btn_site s_modal_view">View Others</asp:HyperLink>
                                </asp:Panel>
                            </div>
                        </asp:View>
                        <asp:View runat="server" ID="CheckboxView">
                            <div class="si_values">
                                <asp:Repeater runat="server" ID="rptCheckboxOptions" OnItemDataBound="OptionsRepeaterItemDataBound">
                                    <HeaderTemplate>
                                        <div class="si_row si_row_plain">
                                            <div class="si_row_item si_item_left">Answers:</div>
                                            <div class="si_row_item si_item_right">Responses:</div>
                                        </div>
                                    </HeaderTemplate>
                                    <ItemTemplate>    
                                        <div class='<%# "si_row si_row_data si_row_" & container.ItemIndex %>'>
                                            <div class="si_row_item si_item_left"><%# Eval("Title") %></div>
                                            <div class="si_row_data si_item_left">
                                                <asp:LinkButton runat="server" ID="lnkSetAnswerFilter" OnCommand="SetAnswerFilter" CommandName='<%# CurrentSurveyQuestion.SubType %>' CssClass="si_row_data_filter" ToolTip="Filter all results by this answer">                                                
                                                    <asp:Label runat="server" ID="lblAmountFilled" CssClass="si_row_data_fill" Style="width:0px;" />
                                                    <asp:Label runat="server" ID="lblResult" CssClass="si_row_data_count" Text="0 / 0%" />
                                                </asp:LinkButton>
                                            </div>
                                        </div>
                                    </ItemTemplate>
                                    <AlternatingItemTemplate>    
                                        <div class='<%# "si_row si_row_data si_row_alt si_row_" & Container.ItemIndex%>'>
                                            <div class="si_row_item si_item_left"><%# Eval("Title") %></div>
                                            <div class="si_row_data si_item_left">
                                                <asp:LinkButton runat="server" ID="lnkSetAnswerFilter" OnCommand="SetAnswerFilter" CommandName='<%# CurrentSurveyQuestion.SubType %>' CssClass="si_row_data_filter" ToolTip="Filter all results by this answer">
                                                    <asp:Label runat="server" ID="lblAmountFilled" CssClass="si_row_data_fill" Style="width:0px;" />
                                                    <asp:Label runat="server" ID="lblResult" CssClass="si_row_data_count" Text="0 / 0%" />
                                                </asp:LinkButton>
                                            </div>
                                        </div>
                                    </AlternatingItemTemplate>
                                </asp:Repeater>

                                <asp:Panel runat="server" ID="pnlTextViewButtonCheckbox" CssClass="si_row si_row_data si_row_view">
                                    <asp:HyperLink runat="server" ID="btnTextViewButtonCheckbox" CssClass="btn_site s_modal_view">View Others</asp:HyperLink>
                                </asp:Panel>
                            </div>
                        </asp:View>
                        <asp:View runat="server" ID="MenuView">
                            <div class="si_values">
                                <asp:Repeater runat="server" ID="rptMenuOptions" OnItemDataBound="OptionsRepeaterItemDataBound">
                                    <HeaderTemplate>
                                        <div class="si_row si_row_plain">
                                            <div class="si_row_item si_item_left">Answers:</div>
                                            <div class="si_row_item si_item_right">Responses:</div>
                                        </div>
                                    </HeaderTemplate>
                                    <ItemTemplate>    
                                        <div class='<%# "si_row si_row_data si_row_" & Container.ItemIndex%>'>
                                            <div class="si_row_item si_item_left"><%# Eval("Title") %></div>
                                            <div class="si_row_data si_item_left">
                                                <asp:LinkButton runat="server" ID="lnkSetAnswerFilter" OnCommand="SetAnswerFilter" CommandName='<%# CurrentSurveyQuestion.SubType %>' CssClass="si_row_data_filter" ToolTip="Filter all results by this answer">
                                                    <asp:Label runat="server" ID="lblAmountFilled" CssClass="si_row_data_fill" Style="width:0px;" />
                                                    <asp:Label runat="server" ID="lblResult" CssClass="si_row_data_count" Text="0 / 0%" />
                                                </asp:LinkButton>
                                            </div>
                                        </div>
                                    </ItemTemplate>
                                    <AlternatingItemTemplate>    
                                        <div class='<%# "si_row si_row_data si_row_alt si_row_" & Container.ItemIndex%>'>
                                            <div class="si_row_item si_item_left"><%# Eval("Title") %></div>
                                            <div class="si_row_data si_item_left">
                                                <asp:LinkButton runat="server" ID="lnkSetAnswerFilter" OnCommand="SetAnswerFilter" CommandName='<%# CurrentSurveyQuestion.SubType %>' CssClass="si_row_data_filter" ToolTip="Filter all results by this answer">
                                                    <asp:Label runat="server" ID="lblAmountFilled" CssClass="si_row_data_fill" Style="width:0px;" />
                                                    <asp:Label runat="server" ID="lblResult" CssClass="si_row_data_count" Text="0 / 0%" />
                                                </asp:LinkButton>
                                            </div>
                                        </div>
                                    </AlternatingItemTemplate>
                                </asp:Repeater>

                                <asp:Panel runat="server" ID="pnlTextViewButtonMenu" CssClass="si_row si_row_data si_row_view">
                                    <asp:HyperLink runat="server" ID="btnTextViewButtonMenu" CssClass="btn_site s_modal_view">View Others</asp:HyperLink>
                                </asp:Panel>
                            </div>
                        </asp:View>
                        <asp:View runat="server" ID="RankView">
                            <div class="si_values">
                                <div class="si_row si_row_plain">
                                    <div class="si_row_item si_item_left">Ranked:</div>
                                </div>
                                <div class="si_row si_row_header">
                                    <div class="si_row_header_wrapper">
                                        <asp:Repeater runat="server" ID="rptRankSubQuestionAnswers" OnItemDataBound="RankSubQuestionAnswersRepeaterItemDataBound">
                                            <ItemTemplate>
                                                <div runat="server" id="si_row_header_item" class="si_row_header_item">
                                                    <span><%# Container.DataItem.ToString() %></span>
                                                </div>    
                                            </ItemTemplate>
                                        </asp:Repeater>
                                    </div>
                                    <div class="si_row_header_item si_row_header_item_start"><span>Total Responses</span></div>
                                    <div class="si_row_header_item"><span>Not Answered</span></div>
                                    <div class="si_row_header_item si_row_header_graph"><span>View Graphs</span></div>
                                </div>
                                <asp:Repeater runat="server" ID="rptRankSubQuestions" OnItemDataBound="RankSubQuestionsRepeaterItemDataBound">
                                    <ItemTemplate> 
                                        <div class="si_row si_row_data">
                                            <div class="si_row_item si_item_left"><%# Eval("Title")%></div>
                                            <div class="si_row_data_wrapper">
                                                <asp:Repeater runat="server" ID="rptRankSubQuestionResults" OnItemDataBound="RankSubQuestionResultsRepeaterItemDataBound">
                                                    <ItemTemplate>    
                                                        <div runat="server" id="si_row_data_item" class="si_row si_row_data">
                                                            <asp:LinkButton runat="server" ID="lnkSetAnswerFilter" OnCommand="SetAnswerFilter" CommandName='<%# CurrentSurveyQuestion.SubType %>' CssClass="si_row_data_filter" ToolTip="Filter all results by this answer">  
                                                                <asp:Label runat="server" ID="lblResult" CssClass="si_row_data_count" Text="0" />
                                                            </asp:LinkButton>
                                                        </div>
                                                    </ItemTemplate>
                                                </asp:Repeater>
                                            </div>
                                            <div class="si_row_total si_row_total_start"><asp:Label runat="server" ID="lblTotalResponses" Text="0" /></div>
                                            <div class="si_row_total"><asp:Label runat="server" ID="lblNotAnswered" Text="0" /></div>
                                            <div class="si_row_total si_row_total_graph">
                                                <asp:HyperLink runat="server" ID="lnkViewGraphs" CssClass="ir btn_graph" Target="_blank" NavigateUrl='<%# GetGraphLink(Nothing, Eval("ID"))%>'>View Graphs</asp:HyperLink>
                                            </div>
                                        </div>
                                    </ItemTemplate>
                                    <AlternatingItemTemplate>    
                                        <div class="si_row si_row_alt si_row_data">
                                            <div class="si_row_item si_item_left"><%# Eval("Title")%></div>
                                            <div class="si_row_data_wrapper">
                                                <asp:Repeater runat="server" ID="rptRankSubQuestionResults" OnItemDataBound="RankSubQuestionResultsRepeaterItemDataBound">
                                                    <ItemTemplate>    
                                                        <div runat="server" id="si_row_data_item" class="si_row si_row_data">
                                                            <asp:LinkButton runat="server" ID="lnkSetAnswerFilter" OnCommand="SetAnswerFilter" CommandName='<%# CurrentSurveyQuestion.SubType %>' CssClass="si_row_data_filter" ToolTip="Filter all results by this answer">  
                                                                <asp:Label runat="server" ID="lblResult" CssClass="si_row_data_count" Text="0" />
                                                            </asp:LinkButton>
                                                        </div>
                                                    </ItemTemplate>
                                                </asp:Repeater>
                                            </div>
                                            <div class="si_row_total si_row_total_start"><asp:Label runat="server" ID="lblTotalResponses" Text="0" /></div>
                                            <div class="si_row_total"><asp:Label runat="server" ID="lblNotAnswered" Text="0" /></div>
                                            <div class="si_row_total si_row_total_graph">
                                                <asp:HyperLink runat="server" ID="lnkViewGraphs" CssClass="ir btn_graph" Target="_blank" NavigateUrl='<%# GetGraphLink(Nothing, Eval("ID"))%>'>View Graphs</asp:HyperLink>
                                            </div>
                                        </div>
                                    </AlternatingItemTemplate>
                                </asp:Repeater>
                            </div>
                        </asp:View>

                        <asp:View runat="server" ID="MulitTextBoxView">
                            <div runat="server" ID="div_text_values_multi" class="si_values">
                                <asp:Panel runat="server" ID="pnlTextViewButtonMulti" CssClass="si_row si_row_data">
                                    <asp:HyperLink runat="server" ID="btnTextViewButtonMulti" CssClass="btn_site s_modal_view">View Responses</asp:HyperLink>
                                </asp:Panel>
                            </div>
                        </asp:View>
                        <asp:View runat="server" ID="NumberView">
                            <div runat="server" ID="div_text_values_number" class="si_row si_values">
                                <div class="si_row_item si_item_left bold">MEAN</div>
                                <div class="si_row_item si_item_right">
                                    <asp:Literal runat="server" ID="litAverageMean" />
                                </div>
                            </div>
                        </asp:View>
                    </asp:MultiView>

                    <div runat="server" id="div_TotalClicks" class="si_row si_row_totals">
                        <div class="si_row_item si_item_left bold">TOTAL CLICKS</div>
                        <div class="si_row_item si_item_right"><asp:Label runat="server" ID="lblTotalClicks" Text="0" /></div>
                    </div>
                    <div runat="server" id="div_TotalResponses" class="si_row si_row_totals">
                        <div class="si_row_item si_item_left bold">TOTAL RESPONSES</div>
                        <div class="si_row_item si_item_right"><asp:Label runat="server" ID="lblTotalResponses" Text="0" /></div>
                    </div>
                    <div runat="server" id="div_TotalNotAnswered" class="si_row si_row_totals">
                        <div class="si_row_item si_item_left">Not Answered</div>
                        <div class="si_row_item si_item_right"><asp:Label runat="server" ID="lblTotalNotAnswered" Text="0" /></div>
                    </div>
                </div>
                <div class="si_graph">
                    <asp:PlaceHolder runat="server" ID="phGraph" />
                    <asp:HyperLink runat="server" ID="lnkViewGraphs" CssClass="btn_graph_full" Target="_blank" NavigateUrl="#" Visible="false">View and download graphs</asp:HyperLink>
                    <asp:HiddenField runat="server" ID="hdnGraph" />
                </div>

                <%--<asp:Panel runat="server" ID="pnlTextValues" CssClass="s_modal si_modal_textvalues" Visible="false">
                    <div class="s_modal_inner">
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
                                        No data found
                                    </div>
                                </EmptyDataTemplate>
                            </asp:ListView>
                        </div>

                        <a href="#" class="btn_site s_modal_close s_modal_textvalues_close">Close</a>
                    </div>
                </asp:Panel>--%>

            </div>
        </asp:View>
        <asp:View runat="server" ID="CantLoadView">
            <p>
                There was a problem loading your survey. Please try again.
            </p>
        </asp:View>
    </asp:MultiView>

