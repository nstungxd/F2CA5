<?php /* Smarty version 2.6.0, created on 2015-06-11 17:31:39
         compiled from jsvars.tpl */ ?>
<?php echo '
<script type="text/javascript">
    var SITE_URL 				            = \'';  echo $this->_tpl_vars['SITE_URL'];  echo '\';
    var SITE_URL_DUM 				       = \'';  echo $this->_tpl_vars['SITE_URL_DUM'];  echo '\';
    var PRJ_DB_PREFIX						= \'';  echo $this->_tpl_vars['PRJ_DB_PREFIX'];  echo '\';
    var PRJ_CONST_PREFIX					= \'';  echo $this->_tpl_vars['PRJ_CONST_PREFIX'];  echo '\';
    var SITE_IMAGES 				       = \'';  echo $this->_tpl_vars['SITE_IMAGES'];  echo '\';
    var SITE_JS_AJAX 			            = \'';  echo $this->_tpl_vars['SITE_JS_AJAX'];  echo '\';
    var REC_LIMIT 				            = \'';  echo $this->_tpl_vars['FRONT_REC_LIMIT'];  echo '\';
    var CHK_DUPLICAT_EMAIL                    = \'';  echo $this->_tpl_vars['CHK_DUPLICAT_EMAIL'];  echo '\';
    var DATEPICKER 				       = \'';  echo $this->_tpl_vars['DATEPICKER'];  echo '\';
    var SESS_ID					= \'';  echo $this->_tpl_vars['iUserId'];  echo '\';
    var LBL_ENTER_USERNAME 				  = \'';  echo $this->_tpl_vars['LBL_ENTER_USERNAME'];  echo '\';
    var LBL_ENTER_PASSWORD 				  = \'';  echo $this->_tpl_vars['LBL_ENTER_PASSWORD'];  echo '\';
    var LBL_LOGIN_FAIL                        = \'';  echo $this->_tpl_vars['LBL_LOGIN_FAIL'];  echo '\';
    var LBL_LOGIN_INFO_SENT                   = \'';  echo $this->_tpl_vars['LBL_LOGIN_INFO_SENT'];  echo '\';
    var LBL_USER_NOT_AVAILABLE                = \'';  echo $this->_tpl_vars['LBL_USER_NOT_AVAILABLE'];  echo '\';
    var MSG_SELECT_ATLEAST_ONE_REC 		  = \'';  echo $this->_tpl_vars['MSG_SELECT_ATLEAST_ONE_REC'];  echo '\';
    var MSG_CONFIRM_DELETE                    = \'';  echo $this->_tpl_vars['MSG_CONFIRM_DELETE'];  echo '\';
    var LBL_EMAIL_ADDRESS                     =\'';  echo $this->_tpl_vars['LBL_EMAIL_ADDRESS'];  echo '\';
    var LBL_COMPANY_NAME                      =\'';  echo $this->_tpl_vars['LBL_COMPANY_NAME'];  echo '\';
    var LBL_COMPANY_REG_NO                    =\'';  echo $this->_tpl_vars['LBL_COMPANY_REG_NO'];  echo '\';
    var LBL_ORGENIZATION_CODE                 =\'';  echo $this->_tpl_vars['LBL_ORGENIZATION_CODE'];  echo '\';
    var LBL_VALID_EMAIL_ADDRESS               =\'';  echo $this->_tpl_vars['LBL_VALID_EMAIL_ADDRESS'];  echo '\';
    var LBL_ZIPCODE                           =\'';  echo $this->_tpl_vars['LBL_ZIPCODE'];  echo '\';
    var LBL_ORGANIZATION_TYPE                 =\'';  echo $this->_tpl_vars['LBL_ORGANIZATION_TYPE'];  echo '\';
    var CRETE_METHO_ALLOWED                   =\'';  echo $this->_tpl_vars['CRETE_METHO_ALLOWED'];  echo '\';
    var LBL_VERIFICATION                      =\'';  echo $this->_tpl_vars['LBL_VERIFICATION'];  echo '\';
    var LBL_ENTER_USER_NAME                   =\'';  echo $this->_tpl_vars['LBL_ENTER_USER_NAME'];  echo '\';
    var LBL_EMAIL_TAKEN                       =\'';  echo $this->_tpl_vars['LBL_EMAIL_TAKEN'];  echo '\';
    var LBL_USERNAME_TAKEN                    =\'';  echo $this->_tpl_vars['LBL_USERNAME_TAKEN'];  echo '\';
    var LBL_FIVE_CHAR_REQUIRED                =\'';  echo $this->_tpl_vars['LBL_FIVE_CHAR_REQUIRED'];  echo '\';
    var LBL_ASSOCIATION_CODE_IN_USE				= \'';  echo $this->_tpl_vars['LBL_ASSOCIATION_CODE_IN_USE'];  echo '\';
    var LBL_ACCOUNT_BLOCK							= \'';  echo $this->_tpl_vars['LBL_ACCOUNT_BLOCK'];  echo '\';
    var LBL_ACCOUNT_INACTIVE						= \'';  echo $this->_tpl_vars['LBL_ACCOUNT_INACTIVE'];  echo '\';
    var LBL_ACCOUNT_NOT_VARIFIED					= \'';  echo $this->_tpl_vars['LBL_ACCOUNT_NOT_VARIFIED'];  echo '\';
    var LBL_ENTER_PO_CODE							= \'';  echo $this->_tpl_vars['LBL_ENTER_PO_CODE'];  echo '\';
    var LBL_POCODE_INUSE								= \'';  echo $this->_tpl_vars['LBL_POCODE_INUSE'];  echo '\';
    var LBL_ENTER_INV_CODE								= \'';  echo $this->_tpl_vars['LBL_ENTER_INV_CODE'];  echo '\';
    var LBL_INVCODE_INUSE								= \'';  echo $this->_tpl_vars['LBL_INVCODE_INUSE'];  echo '\';
    var LBL_ORDER_TYPE							= \'';  echo $this->_tpl_vars['LBL_ORDER_TYPE'];  echo '\';
    var LBL_SELECT_ORDER_TYPE							= \'';  echo $this->_tpl_vars['LBL_SELECT_ORDER_TYPE'];  echo '\';
    var LBL_ORDER_DESCRIPTION							= \'';  echo $this->_tpl_vars['LBL_ORDER_DESCRIPTION'];  echo '\';
    var LBL_SELECT_INV_TYPE							= \'';  echo $this->_tpl_vars['LBL_SELECT_INV_TYPE'];  echo '\';
    var LBL_DIGITS_ONLY							= \'';  echo $this->_tpl_vars['LBL_DIGITS_ONLY'];  echo '\';
    var LBL_ENTER								= \'';  echo $this->_tpl_vars['LBL_ENTER'];  echo '\';
    var LBL_INVOICE_TYPE							= \'';  echo $this->_tpl_vars['LBL_INVOICE_TYPE'];  echo '\';
    var LBL_ITEM_CODE							= \'';  echo $this->_tpl_vars['LBL_ITEM_CODE'];  echo '\';
    var LBL_INVOICE_DESCRIPTION							= \'';  echo $this->_tpl_vars['LBL_INVOICE_DESCRIPTION'];  echo '\';
    var LBL_UNIT_MEASURE							= \'';  echo $this->_tpl_vars['LBL_UNIT_MEASURE'];  echo '\';
    var LBL_QUANTITY							= \'';  echo $this->_tpl_vars['LBL_QUANTITY'];  echo '\';
    var LBL_PRICE							= \'';  echo $this->_tpl_vars['LBL_PRICE'];  echo '\';
    var LBL_AMOUNT							= \'';  echo $this->_tpl_vars['LBL_AMOUNT'];  echo '\';
    var LBL_VAT							= \'';  echo $this->_tpl_vars['LBL_VAT'];  echo '\';
    var LBL_OTHER_TAX							= \'';  echo $this->_tpl_vars['LBL_OTHER_TAX'];  echo '\';
    var LBL_LINE_TOTAL							= \'';  echo $this->_tpl_vars['LBL_LINE_TOTAL'];  echo '\';
    var LBL_WITH_HOLDING_TAX							= \'';  echo $this->_tpl_vars['LBL_WITH_HOLDING_TAX'];  echo '\';
    var LBL_PURCHASE_ORDER							= \'';  echo $this->_tpl_vars['LBL_PURCHASE_ORDER'];  echo '\';
    var LBL_PO_REL_LINE							= \'';  echo $this->_tpl_vars['LBL_PO_REL_LINE'];  echo '\';
    var LBL_RECEIPT							= \'';  echo $this->_tpl_vars['LBL_RECEIPT'];  echo '\';
    var LBL_NUMERIC_ONLY						= \'';  echo $this->_tpl_vars['LBL_NUMERIC_ONLY'];  echo '\';
    var LBL_ENTER_ITEM_CODE					= \'';  echo $this->_tpl_vars['LBL_ENTER_ITEM_CODE'];  echo '\';
    var LBL_ENTER_UNIT_OF_MEASURE			= \'';  echo $this->_tpl_vars['LBL_ENTER_UNIT_OF_MEASURE'];  echo '\';
    var LBL_ITEM_CODE_IN_USE				= \'';  echo $this->_tpl_vars['LBL_ITEM_CODE_IN_USE'];  echo '\';
    var LBL_ENTER_COMP_REG_CODE_NAME 	= \'';  echo $this->_tpl_vars['LBL_ENTER_COMP_REG_CODE_NAME'];  echo '\';
    var LBL_EXCEEDED_MAX_VALUE 			= \'';  echo $this->_tpl_vars['LBL_EXCEEDED_MAX_VALUE'];  echo '\';
    var LBL_SELECT_ONE_SUP_ORG 			= \'';  echo $this->_tpl_vars['LBL_SELECT_ONE_SUP_ORG'];  echo '\';
    var LBL_SELECT_SELLER_ORG 				= \'';  echo $this->_tpl_vars['LBL_SELECT_SELLER_ORG'];  echo '\';
    var MSG_CON_PASS 							= \'';  echo $this->_tpl_vars['MSG_CON_PASS'];  echo '\';
    var LBL_SURE_TO_PROCEED 				= \'';  echo $this->_tpl_vars['LBL_SURE_TO_PROCEED'];  echo '\';
    var LBL_ENCRYPT_EXPORT 					= \'';  echo $this->_tpl_vars['LBL_ENCRYPT_EXPORT'];  echo '\';
    var LBL_GROUP_NAME_TAKEN            = \'';  echo $this->_tpl_vars['LBL_GROUP_NAME_TAKEN'];  echo '\';
    var LBL_COMP_CODE_TAKEN             = \'';  echo $this->_tpl_vars['LBL_COMP_CODE_TAKEN'];  echo '\';
    var LBL_ONLY_APLHA_NUM              = \'';  echo $this->_tpl_vars['MSG_ONLY_ALPHA_NUMERIC'];  echo '\';
    var LBL_ORGANIZATION             	= \'';  echo $this->_tpl_vars['LBL_ORGANIZATION'];  echo '\';
    var LBL_SELECT             			= \'';  echo $this->_tpl_vars['LBL_SELECT'];  echo '\';
    var MSG_CSV_XML_ALLOWED 			= \'';  echo $this->_tpl_vars['MSG_CSV_XML_ALLOWED'];  echo '\';
    var LBL_RATE 						= \'';  echo $this->_tpl_vars['LBL_RATE'];  echo '\';
    var LBL_CURRENCY 					= \'';  echo $this->_tpl_vars['LBL_CURRENCY'];  echo '\';
    var LBL_ENTER_PO_BUYER_CODE         = \'';  echo $this->_tpl_vars['LBL_ENTER_PO_BUYER_CODE'];  echo '\';
    var LBL_PO_BUYER_CODE_INUSE         = \'';  echo $this->_tpl_vars['LBL_PO_BUYER_CODE_INUSE'];  echo '\';
    var LBL_ENTER_INV_SUPPLIER_CODE     = \'';  echo $this->_tpl_vars['LBL_ENTER_INV_SUPPLIER_CODE'];  echo '\';
    var LBL_INV_SUPPLIER_CODE_INUSE     = \'';  echo $this->_tpl_vars['LBL_INV_SUPPLIER_CODE_INUSE'];  echo '\';
    var LBL_CODE_INUSE 						= \'';  echo $this->_tpl_vars['LBL_CODE_INUSE'];  echo '\';
    var LBL_EXCEEDS_MAX_VALUE_OF_PERCENT = \'';  echo $this->_tpl_vars['LBL_EXCEEDS_MAX_VALUE_OF_PERCENT'];  echo '\';
    var LBL_SUPPLIER_ASSOCIATION_CODE   = \'';  echo $this->_tpl_vars['LBL_SUPPLIER_ASSOCIATION_CODE'];  echo '\';
    var LBL_IS_ALREADY_IN_USE           = \'';  echo $this->_tpl_vars['LBL_IS_ALREADY_IN_USE'];  echo '\';
    var LBL_ENTER_SUPPLIER_ASSOCIATION_CODE   = \'';  echo $this->_tpl_vars['LBL_ENTER_SUPPLIER_ASSOCIATION_CODE'];  echo '\';
    var MSG_SELECT_BUYER_ORGANIZATION   = \'';  echo $this->_tpl_vars['MSG_SELECT_BUYER_ORGANIZATION'];  echo '\';
    var MSG_ENTER_BUYER_ORGANIZATION_NAME = \'';  echo $this->_tpl_vars['MSG_ENTER_BUYER_ORGANIZATION_NAME'];  echo '\';
    var LBL_NO_ASSOCIATIONS_CREATED     = \'';  echo $this->_tpl_vars['LBL_NO_ASSOCIATIONS_CREATED'];  echo '\';
    var LBL_MUST_BE_NUMERIC = \'';  echo $this->_tpl_vars['LBL_MUST_BE_NUMERIC'];  echo '\';
    var LBL_PERCENT_LESSTHAN_100 = \'';  echo $this->_tpl_vars['LBL_PERCENT_LESSTHAN_100'];  echo '\';
    var LBL_PRODUCT_ALREADY_INASSOCIATION_WITH_SELECTED_BUYER2 = \'';  echo $this->_tpl_vars['LBL_PRODUCT_ALREADY_INASSOCIATION_WITH_SELECTED_BUYER2'];  echo '\';
    var LBL_BUYER_ALREADY_INASSOCIATION_WITH_SELECTED_BUYER2 = \'';  echo $this->_tpl_vars['LBL_BUYER_ALREADY_INASSOCIATION_WITH_SELECTED_BUYER2'];  echo '\';
    var LBL_SUPPLIER_ALREADY_INASSOCIATION_WITH_SELECTED_BUYER2 = \'';  echo $this->_tpl_vars['LBL_SUPPLIER_ALREADY_INASSOCIATION_WITH_SELECTED_BUYER2'];  echo '\';
    var LBL_BUYER_ALREADY_INASSOCIATION_WITH_SELECTED_BUYER2_BPRODUCT = \'';  echo $this->_tpl_vars['LBL_BUYER_ALREADY_INASSOCIATION_WITH_SELECTED_BUYER2_BPRODUCT'];  echo '\';
    var LBL_SUPPLIER_ALREADY_INASSOCIATION_WITH_SELECTED_BUYER2_SPRODUCT = \'';  echo $this->_tpl_vars['LBL_SUPPLIER_ALREADY_INASSOCIATION_WITH_SELECTED_BUYER2_SPRODUCT'];  echo '\';
    var LBL_MUSTBE_LESSTHAN_GLOBALLIMIT = \'';  echo $this->_tpl_vars['LBL_MUSTBE_LESSTHAN_GLOBALLIMIT'];  echo '\';
    var LBL_PERCENT_MUST_NOT_EXCEED_100 = \'';  echo $this->_tpl_vars['LBL_PERCENT_MUST_NOT_EXCEED_100'];  echo '\';
    var LBL_START_DATE_LESS_THAN_TODAY = \'';  echo $this->_tpl_vars['LBL_START_DATE_LESS_THAN_TODAY'];  echo '\';
    var LBL_END_DATE_GREATER_THAN_START_DATE = \'';  echo $this->_tpl_vars['LBL_END_DATE_GREATER_THAN_START_DATE'];  echo '\';
    var LBL_RFQ2_CODE_INUSE = \'';  echo $this->_tpl_vars['LBL_RFQ2_CODE_INUSE'];  echo '\';
    var LBL_VALUE_MUST_BE_GREATER_THAN_ZERO = \'';  echo $this->_tpl_vars['LBL_VALUE_MUST_BE_GREATER_THAN_ZERO'];  echo '\';
    var LBL_INCORRECT_OLD_PASSWORD = \'';  echo $this->_tpl_vars['LBL_INCORRECT_OLD_PASSWORD'];  echo '\';
    var MSG_PASSWORD_MISMATCH = \'';  echo $this->_tpl_vars['MSG_PASSWORD_MISMATCH'];  echo '\';
    var MSG_PASSWORD_LENGTH = \'';  echo $this->_tpl_vars['MSG_PASSWORD_LENGTH'];  echo '\';
    var MSG_CONFIRM_DEL = \'';  echo $this->_tpl_vars['MSG_CONFIRM_DEL'];  echo '\';
    var LBL_RFQ2 = \'';  echo $this->_tpl_vars['LBL_RFQ2'];  echo '\';
    var LBL_AWARD = \'';  echo $this->_tpl_vars['LBL_AWARD'];  echo '\';
    var LBL_END_DATE_LESS_THAN_CURRENT_TIME = \'';  echo $this->_tpl_vars['LBL_END_DATE_LESS_THAN_CURRENT_TIME'];  echo '\';
    var LBL_CODE_NOT_MATCHED = \'';  echo $this->_tpl_vars['LBL_CODE_NOT_MATCHED'];  echo '\';
    var LBL_WRONG_USER_DETAILS = \'';  echo $this->_tpl_vars['LBL_WRONG_USER_DETAILS'];  echo '\';
    var LBL_REPORT_NOT_AVAILABLE = \'';  echo $this->_tpl_vars['LBL_REPORT_NOT_AVAILABLE'];  echo '\';
    var LBL_DISCOUNT = \'';  echo $this->_tpl_vars['LBL_DISCOUNT'];  echo '\';
    var LBL_CHARGE = \'';  echo $this->_tpl_vars['LBL_CHARGE'];  echo '\';
    var LBL_RATE = \'';  echo $this->_tpl_vars['LBL_RATE'];  echo '\';
    var LBL_LINE_TYPE = \'';  echo $this->_tpl_vars['LBL_LINE_TYPE'];  echo '\';
    var LBL_DESCRIPTION = \'';  echo $this->_tpl_vars['LBL_DESCRIPTION'];  echo '\';
    var LBL_PART_NO = \'';  echo $this->_tpl_vars['LBL_PART_NO'];  echo '\';
	var LBL_NO_MORE_ITEMS_MSG = \'';  echo $this->_tpl_vars['LBL_NO_MORE_ITEMS_MSG'];  echo '\'
</script>
'; ?>