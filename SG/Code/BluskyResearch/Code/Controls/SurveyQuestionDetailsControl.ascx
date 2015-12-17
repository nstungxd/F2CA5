<%@ Control Language="VB" AutoEventWireup="false" CodeFile="SurveyQuestionDetailsControl.ascx.vb" Inherits="Controls_SurveyQuestionDetailsControl" %>

    <asp:MultiView runat="server" ID="mvSurveyQuestionDetails" ActiveViewIndex="0">
        <asp:View runat="server" ID="LoadedView">

            <div runat="server" id="si_item" class="survey_item surveyquestion_item clearfix">
                                
                <div class="si_title clearfix">
                   <asp:Literal runat="server" ID="litQuestionTitle" />
                </div>

                <div runat="server" id="si_dataitem" class="si_data">

                    <asp:MultiView runat="server" ID="mvQuestion" ActiveViewIndex="0">
                        <asp:View runat="server" ID="TextView">
                            <div class="si_values">
                                <div class="si_row si_row_plain">
                                    <div class="si_row_item si_item_left">Answer:</div>
                                </div> 
                                <div class="si_row si_row_data">
                                    <div class="si_row_item si_item_left">
                                        <asp:Literal runat="server" ID="litTextAnswer" Text="Answer not supplied" />
                                    </div>
                                </div>
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
                                </div>
                                <asp:Repeater runat="server" ID="rptTableSubQuestions" OnItemDataBound="SubQuestionsRepeaterItemDataBound">
                                    <ItemTemplate>    
                                        <div class="si_row si_row_data">
                                            <div class="si_row_item si_item_left"><%# Eval("Title")%></div>
                                            <div class="si_row_data_wrapper">
                                                <asp:Repeater runat="server" ID="rptTableSubQuestionResults" OnItemDataBound="TableSubQuestionResultsRepeaterItemDataBound">
                                                    <ItemTemplate>    
                                                        <div runat="server" id="si_row_data_item" class="si_row si_row_data">
                                                            <asp:Label runat="server" ID="lblResult" CssClass="si_row_data_chk si_row_data_chk_off">
                                                                <asp:Image runat="server" ID="imgCheck" ImageUrl="~/Media/Images/check.png" AlternateText="Check" Visible="false" />
                                                            </asp:Label>
                                                        </div>
                                                    </ItemTemplate>
                                                </asp:Repeater>
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
                                                            <asp:Label runat="server" ID="lblResult" CssClass="si_row_data_chk si_row_data_chk_off">
                                                                <asp:Image runat="server" ID="imgCheck" ImageUrl="~/Media/Images/check.png" AlternateText="Check" Visible="false" />
                                                            </asp:Label>
                                                        </div>
                                                    </ItemTemplate>
                                                </asp:Repeater>
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
                                                <asp:Label runat="server" ID="lblResult" CssClass="si_row_data_chk si_row_data_chk_off">
                                                    <asp:Image runat="server" ID="imgCheck" ImageUrl="~/Media/Images/check.png" AlternateText="Check" Visible="false" />
                                                </asp:Label>
                                                <asp:Label runat="server" ID="lblOtherAnswer" CssClass="si_row_data_other" Text="" />
                                            </div>
                                        </div>
                                    </ItemTemplate>
                                    <AlternatingItemTemplate>    
                                        <div class='<%# "si_row si_row_data si_row_alt si_row_" & Container.ItemIndex%>'>
                                            <div class="si_row_item si_item_left"><%# Eval("Title") %></div>
                                            <div class="si_row_data si_item_left">
                                                <asp:Label runat="server" ID="lblResult" CssClass="si_row_data_chk si_row_data_chk_off">
                                                    <asp:Image runat="server" ID="imgCheck" ImageUrl="~/Media/Images/check.png" AlternateText="Check" Visible="false" />
                                                </asp:Label>
                                                <asp:Label runat="server" ID="lblOtherAnswer" CssClass="si_row_data_other" Text="" />
                                            </div>
                                        </div>
                                    </AlternatingItemTemplate>
                                </asp:Repeater>
                            </div>
                        </asp:View>
                        <asp:View runat="server" ID="CheckboxView">
                            <div class="si_values">
                                <asp:Repeater runat="server" ID="rptCheckboxOptions" OnItemDataBound="rptCheckboxOptions_ItemDataBound">
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
                                                <asp:Label runat="server" ID="lblResult" CssClass="si_row_data_chk si_row_data_chk_off">
                                                    <asp:Image runat="server" ID="imgCheck" ImageUrl="~/Media/Images/check.png" AlternateText="Check" Visible="false" />
                                                </asp:Label>
                                                <asp:Label runat="server" ID="lblOtherAnswer" CssClass="si_row_data_other" Text="" />
                                            </div>
                                        </div>
                                    </ItemTemplate>
                                    <AlternatingItemTemplate>    
                                        <div class='<%# "si_row si_row_data si_row_alt si_row_" & Container.ItemIndex%>'>
                                            <div class="si_row_item si_item_left"><%# Eval("Title") %></div>
                                            <div class="si_row_data si_item_left">
                                                <asp:Label runat="server" ID="lblResult" CssClass="si_row_data_chk si_row_data_chk_off">
                                                    <asp:Image runat="server" ID="imgCheck" ImageUrl="~/Media/Images/check.png" AlternateText="Check" Visible="false" />
                                                </asp:Label>
                                                <asp:Label runat="server" ID="lblOtherAnswer" CssClass="si_row_data_other" Text="" />
                                            </div>
                                        </div>
                                    </AlternatingItemTemplate>
                                </asp:Repeater>
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
                                                <asp:Label runat="server" ID="lblResult" CssClass="si_row_data_chk si_row_data_chk_off">
                                                    <asp:Image runat="server" ID="imgCheck" ImageUrl="~/Media/Images/check.png" AlternateText="Check" Visible="false" />
                                                </asp:Label>
                                                <asp:Label runat="server" ID="lblOtherAnswer" CssClass="si_row_data_other" Text="" />
                                            </div>
                                        </div>
                                    </ItemTemplate>
                                    <AlternatingItemTemplate>    
                                        <div class='<%# "si_row si_row_data si_row_alt si_row_" & Container.ItemIndex%>'>
                                            <div class="si_row_item si_item_left"><%# Eval("Title") %></div>
                                            <div class="si_row_data si_item_left">
                                                <asp:Label runat="server" ID="lblResult" CssClass="si_row_data_chk si_row_data_chk_off">
                                                    <asp:Image runat="server" ID="imgCheck" ImageUrl="~/Media/Images/check.png" AlternateText="Check" Visible="false" />
                                                </asp:Label>
                                                <asp:Label runat="server" ID="lblOtherAnswer" CssClass="si_row_data_other" Text="" />
                                            </div>
                                        </div>
                                    </AlternatingItemTemplate>
                                </asp:Repeater>
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
                                </div>
                                <asp:Repeater runat="server" ID="rptRankSubQuestions" OnItemDataBound="RankSubQuestionsRepeaterItemDataBound">
                                    <ItemTemplate> 
                                        <div class="si_row si_row_data">
                                            <div class="si_row_item si_item_left"><%# Eval("Title")%></div>
                                            <div class="si_row_data_wrapper">
                                                <asp:Repeater runat="server" ID="rptRankSubQuestionResults" OnItemDataBound="RankSubQuestionResultsRepeaterItemDataBound">
                                                    <ItemTemplate>    
                                                        <div runat="server" id="si_row_data_item" class="si_row si_row_data">
                                                            <asp:Label runat="server" ID="lblResult" CssClass="si_row_data_chk si_row_data_chk_off">
                                                                <asp:Image runat="server" ID="imgCheck" ImageUrl="~/Media/Images/check.png" AlternateText="Check" Visible="false" />
                                                            </asp:Label>
                                                        </div>
                                                    </ItemTemplate>
                                                </asp:Repeater>
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
                                                            <asp:Label runat="server" ID="lblResult" CssClass="si_row_data_chk si_row_data_chk_off">
                                                                <asp:Image runat="server" ID="imgCheck" ImageUrl="~/Media/Images/check.png" AlternateText="Check" Visible="false" />
                                                            </asp:Label>
                                                        </div>
                                                    </ItemTemplate>
                                                </asp:Repeater>
                                            </div>
                                        </div>
                                    </AlternatingItemTemplate>
                                </asp:Repeater>
                            </div>
                        </asp:View>
                        <asp:View runat="server" ID="MulitTextBoxView">
                            <div class="si_values">
                                <asp:Repeater runat="server" ID="rptMultiTextAnswers" OnItemDataBound="rptMultiTextAnswersItemDataBound">
                                    <ItemTemplate>
                                        <div class="si_row si_row_plain">
                                            <div class="si_row_item si_item_left"><%# Eval("OptionTitle")%></div>
                                            <div class="si_row_item si_item_left">
                                                <asp:Literal runat="server" ID="litMultiTextAnswer" Text='<%# Eval("AnswerValue")%>' />
                                            </div>
                                        </div> 
                                    </ItemTemplate>
                                    <AlternatingItemTemplate>
                                        <div class="si_row si_row_plain si_row_alt">
                                            <div class="si_row_item si_item_left"><%# Eval("OptionTitle")%></div>
                                            <div class="si_row_item si_item_left">
                                                <asp:Literal runat="server" ID="litMultiTextAnswer" Text='<%# Eval("AnswerValue")%>' />
                                            </div>
                                        </div> 
                                    </AlternatingItemTemplate>
                                </asp:Repeater>
                            </div>
                        </asp:View>
                        <asp:View runat="server" ID="NumberView">
                            <div class="si_values">
                                <div class="si_row si_row_plain">
                                    <div class="si_row_item si_item_left">Answer:</div>
                                </div> 
                                <div class="si_row si_row_data">
                                    <div class="si_row_item si_item_left"><asp:Literal runat="server" ID="litAverageMean" /></div>
                                </div>
                            </div>
                        </asp:View>

                    </asp:MultiView>
                </div>
            </div>
        </asp:View>
        <asp:View runat="server" ID="CantLoadView">
            <p>
                There was a problem loading your survey. Please try again.
            </p>
        </asp:View>
    </asp:MultiView>