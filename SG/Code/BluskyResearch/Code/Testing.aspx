<%@ Page Title="" Language="VB" MasterPageFile="~/Site.master" AutoEventWireup="false" CodeFile="Testing.aspx.vb" Inherits="Testing" %>

<asp:Content ID="Content1" ContentPlaceHolderID="HeadContent" Runat="Server"></asp:Content>

<asp:Content ID="Content2" ContentPlaceHolderID="MainContent" Runat="Server">

    <article id="central">
        <header>
            <asp:Literal runat="server" ID="litTitle" />
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in. In semper consequat est, eu porta velit mollis nec.</p>
        </header>
        <section>
            <h3>subtitle</h3>

            <asp:Panel runat="server" ID="pnlImageBanner" CssClass="ar_banner">
                <asp:Image runat="server" ID="imgBanner" />            
            </asp:Panel>

            <asp:Literal runat="server" ID="litBodyCopy" />

            <div class="ar_content">
                <asp:Button runat="server" ID="btnGetAllSurveys" Text="GetAllSurveys" />  
            </div>
            
            <div class="ar_content">
                <asp:Button runat="server" ID="btnGetAllSurveyPages" Text="GetAllSurveyPages" />  
            </div>
            
            <div class="ar_content">
                <asp:Button runat="server" ID="btnGetAllSurveyQuestions" Text="GetAllSurveyQuestions" />  
            </div>
            
            <div class="ar_content">
                <asp:Button runat="server" ID="btnGetAllSurveyOptions" Text="GetAllSurveyOptions" />  
            </div>
            
            <div class="ar_content">
                <asp:Button runat="server" ID="btnGetAllSurveyResponses" Text="GetAllSurveyResponses" />  
            </div>
            
            <div class="ar_content">
                <asp:Button runat="server" ID="btnGetAllSurveyStatistics" Text="GetAllSurveyStatistics" />  
            </div>
            
            <div class="ar_content">
                <asp:Literal runat="server" ID="litResults" />
            </div>
                          
        </section>
    </article>

    <aside>
        <h3>aside</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in. In semper consequat est, eu porta velit mollis nec. Curabitur posuere enim eget turpis feugiat tempor. Etiam ullamcorper lorem dapibus velit suscipit ultrices.</p>
    </aside>

</asp:Content>

<asp:Content ID="Content3" ContentPlaceHolderID="ScriptContent" Runat="Server"></asp:Content>
