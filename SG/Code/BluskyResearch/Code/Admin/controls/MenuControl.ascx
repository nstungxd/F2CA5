<%@ Control Language="VB" AutoEventWireup="false" ClassName="MenuControl" Inherits="MenuControl_Behind" CodeFile="MenuControl.ascx.vb" %>
<%@ Register TagPrefix="my" Namespace=" Mycontrols" Assembly="PingCore"  %>

<%--	<asp:Repeater ID="rptItems" runat="server">	
	    <HeaderTemplate>
            <ul id="nav_admin_topf">
	    </HeaderTemplate>
		<ItemTemplate>
            <li>
                <asp:HyperLink ID="lnkItem" runat="server" NavigateUrl='<%# Eval("filename") %>' ToolTip='<%# Eval("name") %>' Text='<%# Eval("name") %>' CssClass="unselected" />
            </li>
		</ItemTemplate>
		<FooterTemplate>	
            </ul>
		</FooterTemplate>
    </asp:Repeater>--%>

    <%--<div id="PageIntro">
            <img class="PageIcon" src="/admin/images/<% = SectionIconFileName %>" alt="Page Icon"/>
            <div id="PageIntroText">
               <% = SectionIntro %>
            </div>
        </div>--%>
	
	<%--<asp:Repeater ID="rptSecondLevelUnused" runat="server">
	
	    <HeaderTemplate>
	        <div id="adminSecondLevel" class="adminmenuwrapper">
	        <div class="adminmenulinkwrapper">
	    </HeaderTemplate>

		<ItemTemplate>
			<div class="menu_item" >
				<asp:MultiView ID="mvLinkMode" runat="server">
					<asp:View ID="vClient" runat="server">
						<asp:HyperLink ID="lnkItem" runat="server" NavigateUrl='<%# eval("ClientLink") %>' ToolTip='<%# eval("AltText") %>' Text='<%# eval("Name") %>' CssClass="unselected" />
					</asp:View>
					<asp:View ID="vServer" runat="server">
						<asp:LinkButton id="btnItem" runat="server" Text='<%# eval("Name") %>' ToolTip='<%# eval("AltText") %>' CommandName="Click" CommandArgument='<%# eval("Code") %>'  CssClass="unselected" />
					</asp:View>
				</asp:MultiView>
			</div>
		</ItemTemplate>
		
		<SeparatorTemplate>
		    <div class="menu_separator"></div>
		</SeparatorTemplate>
		
		<FooterTemplate>
		    </div>
		    </div>
		</FooterTemplate>
		
	</asp:Repeater>--%>
	
	<asp:Repeater ID="rptSecondLevel" runat="server">
	    <HeaderTemplate>
            <ul id="nav_admin_sub">
	    </HeaderTemplate>

		<ItemTemplate>
            <li>
			    <asp:HyperLink ID="lnkItem" runat="server" NavigateUrl='<%# "/admin/sections/" & Eval("filename") %>' ToolTip='<%# Eval("name") %>' Text='<%# Eval("name") %>' CssClass="unselected" />
            </li>
		</ItemTemplate>
		
		<FooterTemplate>
            </ul>
		</FooterTemplate>
	</asp:Repeater>

