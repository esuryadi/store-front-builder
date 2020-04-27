/* Copyright Ektron, Inc. 01/30/03 */function JSEventModel(){this.eventHandlers=[];this.initEvent=JSEventModel_initEvent;
 this.raiseEvent=JSEventModel_raiseEvent;this.addEventHandler=JSEventModel_addEventHandler;
 this.invokeEventHandler=JSEventModel_invokeEventHandler;}
function JSEventModel_initEvent(eventName){this.event=new Object();if (eventName){
 this.event.eventName=eventName;} else{this.event.eventName="";} if (typeof this.status !="undefined"){
 this.event.status=this.status;}}
function JSEventModel_raiseEvent(name){if (this.eventHandlers[name]){for (var i=0;
 i < this.eventHandlers[name].length;i++){this.invokeEventHandler(this.eventHandlers[name][i]);
 } } return this.invokeEventHandler(this[name]);}
function JSEventModel_addEventHandler(name,handler){if (!this[name]){this[name]=function(){
 };} if (0==this.eventHandlers.length){this.eventHandlers=new Array();} if (typeof this.eventHandlers[name] !="object" || typeof this.eventHandlers[name].length !="number"){
 var objArray=new Array();this.eventHandlers[this.eventHandlers.length]=objArray;
 this.eventHandlers[name]=objArray;} this.eventHandlers[name][this.eventHandlers[name].length]=handler;
}
function JSEventModel_invokeEventHandler(handler){if (handler){this.vEventHandler=handler;
 switch (typeof this.vEventHandler){case"function": return this.vEventHandler();break;
 case"object": if (this.vEventHandler["raiseEvent"]){return this.vEventHandler.raiseEvent(name);
 } break;case"string": this.vEventHandler=new Function(this.vEventHandler);return this.vEventHandler();
 break;case"undefined": break;default: alert("Invalid type: " + typeof this.vEventHandler);
 } }}
function cloneObject(object){if ("object"==typeof object){var newObject=null;if (object !=null){
 newObject=new Object();for (var propName in object){if (typeof object[propName]=="object"){
 if (null==object[propName]){newObject[propName]=null;} else{newObject[propName]=cloneObject(object[propName]);
 } } else{newObject[propName]=object[propName];} } } return newObject;} else{return object;
 }}
function reconstructObject(sReconstructor){var newObject=new Object();extendObject(newObject,new Function(sReconstructor));
 return newObject;}
function extendObject(object,fnBase){object.overrideMethod=Inheritance_overrideMethod;
 object.extendObjectBase=fnBase;if (arguments.length <=2){object.extendObjectBase();
 } else{var strConstructorCall='object.extendObjectBase(arguments[2]';for (var i=3;
 i < arguments.length;i++){strConstructorCall +=', arguments[' + i +']';} strConstructorCall +=')';
 eval(strConstructorCall);} object.extendObjectBase=null;}
function Inheritance_overrideMethod(strMethodName,fnNewMethod,strBaseName){if (!strBaseName){
 strBaseName="super";} strBaseName +="_" + strMethodName;this[strBaseName]=this[strMethodName];
 this[strMethodName]=fnNewMethod;}
function notifyObject(objNotify,fnNotify,value){var vResult=value;if ("function"==typeof fnNotify){
 if ("object"==typeof objNotify && objNotify){objNotify.notify=fnNotify;vResult=objNotify.notify(value);
 } else{vResult=fnNotify(value);} } return vResult;}
function ClassModel(){this.properties=[];this.defineProperty=ClassModel_defineProperty;
 this.subclassEvent=ClassModel_subclassEvent;this.reconstructor=ClassModel_reconstructor;
 extendObject(this,JSEventModel);}
function ClassModel_defineProperty(name,value){if (0==this.properties.length){this.properties=new Array();
 } this.properties[this.properties.length]=name;this[name]=value;}
function ClassModel_reconstructor(){var sReconstructor="extendObject(this, ClassModel);\n";
 var name="";var value="";for (var i=0;i < this.properties.length;i++){name=this.properties[i];
 value=toLiteral(this[name]);if (value !="undefined"){sReconstructor +="this.defineProperty(\"" + name +"\", " + value +");\n";
 } } return sReconstructor;}
var g_ClassModel_eventCount=0;function ClassModel_subclassEvent(fnOldEvent,sNewEvent){
 if (typeof sNewEvent !="string" || !sNewEvent["length"]){return fnOldEvent;} g_ClassModel_eventCount++;
 var objHook=new ClassModel();var sNewEventName="fnNewEvent" + g_ClassModel_eventCount;
 objHook.defineProperty(sNewEventName,new Function(sNewEvent));if (fnOldEvent){var sOldEventName="fnOldEvent" + g_ClassModel_eventCount;
 objHook.defineProperty(sOldEventName,fnOldEvent);} var sCode="";sCode +="extendObject(this, new Function(unescape('" + escape(objHook.reconstructor()) +"')));\n";
 sCode +="var bResult = this." + sNewEventName +"();\n";if (fnOldEvent){sCode +="if (bResult || 'undefined' == typeof bResult) bResult = this." + sOldEventName +"();\n";
 } sCode +="return bResult;\n";return new Function(sCode);}
function toIdentifier(name){var sId=name +"";sId=sId.replace(/\W/g,"_");sId=sId.replace(/(^\d)/,"id$1");
 return sId;}
function toLiteral(object){var sLiteral="";switch (typeof object){case"undefined": sLiteral="undefined";
 break;case"string": sLiteral='"' + object.replace(/\"/g,'\\\"') +'"';break;case"object": if (null==object){
 sLiteral="null";} else if ("undefined"==typeof object.length){for (var propName in object){
 if (sLiteral.length > 0){sLiteral +=", ";} sLiteral +="'" + propName +"':" + toLiteral(object[propName]);
 } if (sLiteral.length > 0){sLiteral="{" + sLiteral +"}";} else{sLiteral="new Object()";
 } } else if ("function"==typeof object.sort){for (var i=0;i < object.length;i++){
 if (sLiteral.length > 0){sLiteral +=", ";} sLiteral +=toLiteral(object[i]);} if (sLiteral.length > 0){
 sLiteral="[" + sLiteral +"]";} else{sLiteral="new Array()";} } else{sLiteral=object.toString();
 } break;default: sLiteral=object.toString();} return sLiteral;}
function toFunction(object){var fn;switch (typeof object){case"function": fn=object;
 break;case"undefined": case"string": case"object": if (object){eval("fn = " + object.toString());
 } else{fn=new Function();} break;default: fn=new Function("return " + toLiteral(object));
 } return fn;}
function PlatformInfo(){var ua=window.navigator.userAgent.toLowerCase();this.isWindows=(ua.indexOf("win") > -1);
 this.isMac=(ua.indexOf("mac") > -1);this.isSun=(ua.indexOf("sunos") > -1);this.isUnix=( this.isSun || (ua.indexOf("x11") > -1) || (ua.indexOf("irix") > -1) || (ua.indexOf("hp-ux") > -1) || (ua.indexOf("sco") > -1) || (ua.indexOf("unix_sv") > -1) || (ua.indexOf("unix_system_v") > -1) || (ua.indexOf("ncr") > -1) || (ua.indexOf("reliantunix") > -1) || (ua.indexOf("dec") > -1) || (ua.indexOf("osf1") > -1) || (ua.indexOf("dec_alpha") > -1) || (ua.indexOf("alphaserver") > -1) || (ua.indexOf("ultrix") > -1) || (ua.indexOf("alphastation") > -1) || (ua.indexOf("sinix") > -1) || (ua.indexOf("aix") > -1) || (ua.indexOf("inux") > -1) || (ua.indexOf("bsd") > -1) || (ua.indexOf("freebsd") > -1));
 var pOpera=ua.indexOf("opera");this.isOpera=(pOpera > -1);this.isNetscape=((window.navigator.appName=="Netscape") && !this.isOpera);
 this.isNetscape60=false;var pIE=ua.indexOf("msie ");this.isIE=((pIE > -1) && !this.isOpera);
 if (this.isOpera){this.browserVersion=parseFloat(ua.substring(pOpera + 6));} else if (this.isIE){
 this.browserVersion=parseFloat(ua.substring(pIE + 5));} else if (this.isNetscape){
 var pNetscape=ua.indexOf("netscape/");if (pNetscape > -1){this.browserVersion=parseFloat(ua.substring(pNetscape + 9));
 } else{var pNetscape6=ua.indexOf("netscape6");if (pNetscape6 > -1){this.browserVersion=parseFloat(ua.substring(pNetscape6 + 10));
 this.isNetscape60=(this.browserVersion >=6.0 && this.browserVersion < 6.1);} else{
 this.browserVersion=parseFloat(window.navigator.appVersion);if (this.browserVersion >=5.0){
 if (ua.indexOf("rv:0.9.4") > -1){this.browserVersion=6.2;} else if (ua.indexOf("rv:1.") > -1){
 this.browserVersion=7.0;} else{this.isNetscape=false;} } } } } else{this.browserVersion=parseFloat(window.navigator.appVersion);
 }}
function eWebEditProUtil(){this.HTMLEncode=eWebEditProUtil_HTMLEncode;this.isOpenerAvailable=eWebEditProUtil_isOpenerAvailable;
 this.getOpenerInstance=eWebEditProUtil_getOpenerInstance;this.languageCode=eWebEditProUtil_getLanguageCode();
 this.queryArgs=[];var objQuery=eWebEditProUtil_parseQuery();for (var p in objQuery){
 this.queryArgs[this.queryArgs.length]=objQuery[p];this.queryArgs[p]=objQuery[p];
 } this.editorName=this.queryArgs["editorName"];}
function eWebEditProUtil_HTMLEncode(s){var strHTML=s +"";strHTML=strHTML.replace(/\&/g,"&amp;");
 strHTML=strHTML.replace(/\</g,"&lt;");strHTML=strHTML.replace(/\>/g,"&gt;");strHTML=strHTML.replace(/\"/g,"&quot;");
 return strHTML;}
function eWebEditProUtil_getLanguageCode(){var strLanguageCode="";if (navigator.language){
 strLanguageCode=navigator.language;} if (navigator.userLanguage){strLanguageCode=navigator.userLanguage;
 } var strTranslatedLangCodes="zh-tw";if (strTranslatedLangCodes.indexOf(strLanguageCode)==-1){
 strLanguageCode=strLanguageCode.substring(0,2);var strTranslatedLanguages="ar,da,de,es,fr,he,it,ja,ko,nl,pt,ru,sv,zh";
 if (strTranslatedLanguages.indexOf(strLanguageCode)==-1){strLanguageCode="";} } return strLanguageCode;
}
function eWebEditProUtil_isOpenerAvailable(){if (top.opener && !(top.opener.closed) && top.opener.eWebEditPro){
 return true;} else{return false;}}
function eWebEditProUtil_getOpenerInstance(editorName){if (!editorName) editorName=this.editorName;
 if (this.isOpenerAvailable() && editorName){return top.opener.eWebEditPro.instances[editorName];
 } else{return null;}}
function eWebEditProUtil_parseQuery(){var objQuery=new Object();var strQuery=top.location.search.substring(1);
 var aryQuery=strQuery.split("&");var pair=[];for (var i=0;i < aryQuery.length;i++){
 pair=aryQuery[i].split("=");if (2==pair.length){objQuery[unescape(pair[0])]=unescape(pair[1]);
 } } return objQuery;}
var eWebEditProUtil=new eWebEditProUtil;function PluginElement(strTagName){this.tagName=strTagName.toLowerCase();
 this.isEmpty=("embed"==this.tagName);this.width=0;this.height=0;this.parameters=[];
 this.events=[];if (this.isEmpty){this.defineParam=PluginElement_Attr_defineParam;
 } else{this.defineParam=PluginElement_Param_defineParam;} this.defineEvent=PluginElement_defineEvent;
 this.copyHTMLAttributes=PluginElement_copyHTMLAttributes;this.HTMLEncode=eWebEditProUtil_HTMLEncode;
 this.createHTML=PluginElement_createHTML;this.createHTMLAttributes=PluginElement_createHTMLAttributes;
 this.createParametersHTML=PluginElement_createParametersHTML;this.createEventsHTML=PluginElement_createEventsHTML;
 this.defineDocParams=PluginElement_defineDocParams;this.defineNamedParams=PluginElement_defineNamedParams;
 this.defineNamedEvents=PluginElement_defineNamedEvents;}
function PluginElement_copyHTMLAttributes(objSource){this.id=objSource.id;this.name=objSource.name;
 this.width=objSource.width;this.height=objSource.height;}
function PluginElement_Param_defineParam(name,value){if (0==this.parameters.length){
 this.parameters=new Array();} var strValue=value +"";if (strValue.indexOf('"') >=0){
 strValue=this.HTMLEncode(strValue);} this.parameters[this.parameters.length]='\n<param name="' + name +'" value="' + strValue +'">';
}
function PluginElement_Attr_defineParam(name,value){if (0==this.parameters.length){
 this.parameters=new Array();} var strValue=value +"";if (strValue.indexOf('"') >=0){
 strValue=this.HTMLEncode(strValue);} this.parameters[this.parameters.length]='\n' + name +'="' + strValue +'"';
}
function PluginElement_defineEvent(name,value){var errCode=0;if (0==this.events.length){
 this.events=new Array();} if (this["name"]){this.events[this.events.length]='\n<scr' +'ipt language="JavaScript1.2" type="text/javascript"><' +'!--' +'\nfunction ' + toIdentifier(this.name) +'_' + name +'\n{\n' + value +'\n}\n// --' +'><' +'/sc' +'ript>\n';
 } return errCode;}
function PluginElement_createHTML(){var strHTML="";if ("function"==typeof this.createBeforeHTML){
 strHTML +=this.createBeforeHTML();} strHTML +='\n<' + this.tagName +' ';strHTML +=this.createHTMLAttributes();
 if (this.isEmpty || this.defineParam==PluginElement_Attr_defineParam){strHTML +=this.createParametersHTML();
 strHTML +='>';} else{strHTML +='>';strHTML +=this.createParametersHTML();strHTML +='\n</' + this.tagName +'>';
 } if ("function"==typeof this.createAfterHTML){strHTML +=this.createAfterHTML();
 } return strHTML;}
function PluginElement_createHTMLAttributes(){var strHTML="";if (this["id"]){strHTML +='\nid="' + this.id +'"';
 strHTML +='\nname="' + this.id +'"';} else if (this["name"]){strHTML +='\nid="' + this.name +'"';
 strHTML +='\nname="' + this.name +'"';} if ("object"==this.tagName){if (this["classid"]){
 strHTML +='\nclassid="CLSID:' + this.classid +'"';} if (this["codebase"]){strHTML +='\ncodebase="' + this.codebase +'"';
 } } if ("embed"==this.tagName){if (this["mimetype"]){strHTML +='\ntype="' + this.mimetype +'"';
 } if (this["pluginspage"]){strHTML +='\npluginspage="' + this.pluginspage +'"';}
 } if (!this.width || this.width=="0"){this.width=500;} strHTML +='\nwidth="' + this.width +'"';
 if (!this.height || this.height=="0"){this.height=300;} strHTML +='\nheight="' + this.height +'"';
 if (this[this.tagName +"Attributes"]){strHTML +='\n' + this[this.tagName +"Attributes"];
 } return strHTML;}
function PluginElement_createParametersHTML(){var strHTML="";for (var i=0;i < this.parameters.length;
 i++){strHTML +=this.parameters[i];} return strHTML;}
function PluginElement_createEventsHTML(){var strHTML="";for (var i=0;i < this.events.length;
 i++){strHTML +=this.events[i];} return strHTML;}
function PluginElement_defineDocParams(parameters){if (!parameters["charset"]){var objDoc=findDocument(parameters.getEditorDocument(),parameters.editorWindow);
 if (objDoc && objDoc.charset){this.defineParam("charset",objDoc.charset);} else{
 this.defineParam("charset","iso-8859-1");} }}
function PluginElement_defineNamedParams(parameters){var sParamName;var vParamValue;
 for (var i=0;i < parameters.names.length;i++){sParamName=parameters.names[i];vParamValue=parameters[sParamName];
 if (vParamValue){this.defineParam(sParamName,vParamValue);} }}
function PluginElement_defineNamedEvents(parameters){var sEventName;var sEventApi;
 var vEventValue;for (var i=0;i < parameters.events.length;i++){sEventName=parameters.events[i].name;
 sEventApi=sEventName +"(" + parameters.events[i].args +")";vEventValue=parameters[sEventName];
 if (typeof vEventValue=="string"){if (vEventValue.length > 0){var sEventType=sEventName.toLowerCase();
 if ("on"==sEventType.substring(0,2)){sEventType=sEventType.substring(2);} var strEvtObj="eWebEditPro.event = {type:'" + sEventType +"', srcName:'" + this.name +"'};";
 var strEventHandler=strEvtObj + vEventValue;var errCode=this.defineEvent(sEventApi,strEventHandler);
 var strMsg="";if (2==errCode){strMsg="Double quotes are not allowed in an event handler. Please use single quotes.";
 } else{strMsg="Unknown error in event handler. Error code: " + errCode;} if (errCode !=0){
 strMsg +="\n\nEditor name: " + this.name;strMsg +="\nEvent name: " + sEventName;
 strMsg +="\nEvent handler: " + vEventValue;alert(strMsg);} } } else if (typeof vEventValue !="undefined"){
 alert("Event '" + sEventName +"' must be a string.");} }}
function eWebEditProParameters(){var i;this.defineProperty("path",eWebEditProDefaults.path);
 this.defineProperty("maxContentSize",eWebEditProDefaults.maxContentSize);this.defineProperty("editorGetMethod",eWebEditProDefaults.editorGetMethod);
 this.defineProperty("names",new Array());i=0;this.names[i++]="srcPath";this.names[i++]="license";
 this.names[i++]="locale";this.names[i++]="config";this.names[i++]="xmlInfo";this.names[i++]="baseURL";
 this.names[i++]="charset";this.names[i++]="title";this.names[i++]="styleSheet";this.names[i++]="bodyStyle";
 this.names[i++]="hideAboutButton";this.names[i++]="wddx";this.names[i++]="readOnly";
 var name;for (i=0;i < this.names.length;i++){name=this.names[i];if (typeof eWebEditProDefaults[name] !="undefined"){
 this.defineProperty(name,eWebEditProDefaults[name]);} } this.defineProperty("events",new Array());
 i=0;this.events[i++]={name:"ondblclickelement",args:"oelement"};this.events[i++]={
name:"onexeccommand",args:"strcmdname,strtextdata,ldata"};this.events[i++]={name:"onfocus",args:""}
;this.events[i++]={name:"onblur",args:""};for (i=0;i < this.events.length;i++){name=this.events[i].name;
 if (typeof eWebEditProDefaults[name] !="undefined"){this[name]=eWebEditProDefaults[name];
 } } if ("function"==typeof eWebEditProButtonTag){this.buttonTag=new eWebEditProButtonTag();
 } if ("function"==typeof eWebEditProPopup){this.popup=new eWebEditProPopup();} if ("function"==typeof installPopup){
 this.installPopup=new installPopup();} this.getOptionalParameter=eWebEditProParameters_getOptionalParameter;
 this.getEditorDocument=eWebEditProParameters_getEditorDocument;this.relocate=eWebEditProParameters_relocate;
 this.reset=eWebEditProParameters_reset;this.definePropertyName=eWebEditProParameters_definePropertyName;
 this.isLicense=eWebEditProParameters_isLicense;}
eWebEditProParameters.prototype=new ClassModel;function eWebEditProParameters_reset(){
 var i;var name;for (i=0;i < this.properties.length;i++){name=this.properties[i];
 if (typeof this[name] !="object" && typeof eWebEditProDefaults[name] !="undefined"){
 this[name]=eWebEditProDefaults[name];} } for (i=0;i < this.names.length;i++){name=this.names[i];
 if (typeof eWebEditProDefaults[name] !="undefined"){this[name]=eWebEditProDefaults[name];
 } } for (i=0;i < this.events.length;i++){name=this.events[i].name;if (typeof eWebEditProDefaults[name] !="undefined"){
 this[name]=eWebEditProDefaults[name];} }}
function eWebEditProParameters_getOptionalParameter(name,defaultValue){if (typeof this[name] !="undefined"){
 return this[name];} else if (typeof eWebEditProDefaults[name] !="undefined"){return eWebEditProDefaults[name];
 } else{return defaultValue;}}
function eWebEditProParameters_definePropertyName(name){var bDefine=true;if ("undefined"==typeof this[name]){
 if ("undefined"==typeof eWebEditProDefaults[name]){bDefine=false;} else{this[name]=eWebEditProDefaults[name];
 } } else{for (var i=0;i < this.properties.length;i++){if (this.properties[i]==name){
 bDefine=false;} } if (bDefine){this.defineProperty(name,this[name]);} } return bDefine;
}
function eWebEditProParameters_relocate(evalWindow){var prevWindow=this.eWebEditProWindow;
 this.eWebEditProWindow=evalWindow;for (var i=0;i < this.events.length;i++){var vHandler=this[this.events[i].name];
 if ("string"==typeof vHandler && vHandler.length > 0){if (prevWindow){var re=new RegExp("^" + prevWindow +"\.");
 vHandler=vHandler.replace(re,"");} if (this.eWebEditProWindow){this[this.events[i].name]=this.eWebEditProWindow +"." + vHandler;
 } } }}
function eWebEditProParameters_getEditorDocument(){var evalDocument="document";if (this.editorDocument){
 evalDocument=this.editorDocument;} else if (this.editorDocumentLayer){evalDocument=this.editorDocumentLayer;
 } return evalDocument;}
function eWebEditProParameters_isLicense(strModifier,strLicense){if ("string"==typeof strLicense){
 var re=new RegExp("\(([^\)]+\-)?" + strModifier +"(\-[^\(]+)?\)");return (strLicense.search(re) >=0);
 } else{return false;}}
function conditional_write(strHTML,objHtml,parameters){if (objHtml){objHtml.html +=strHTML;
 } if (!parameters.writeDisabled){var evalWindowDocument="";if (parameters.editorWindow){
 evalWindowDocument=parameters.editorWindow +".";} evalWindowDocument +=parameters.getEditorDocument();
 eval(evalWindowDocument +'.write(strHTML)');}}
function findWindow(evalWindow){var objWin=window;if (typeof evalWindow=="string" && evalWindow.length > 0){
 objWin=eval(evalWindow);} return objWin;}
function findDocument(evalDocument,evalWindow){var objDoc=null;if (!evalDocument){
 evalDocument="document";} var objWin=findWindow(evalWindow);if (objWin){if ((("unknown"==typeof objWin.closed) || !objWin.closed) && ("object"==typeof objWin["document"])){
 objDoc=eval('objWin.' + evalDocument);} else{objDoc=null;} } else{objDoc=eval(evalDocument);
 } return objDoc;}
function findElementDocumentLayer(name,evalWindow){var objInfo=findFormAndElement(name,evalWindow);
 return objInfo.evalDocument;}
function findElementForm(name,evalWindow){var objInfo=findFormAndElement(name,evalWindow);
 return objInfo.objForm;}
function findElement(name,evalWindow){var objInfo=findFormAndElement(name,evalWindow);
 return objInfo.objElem;}
function findElementFormName(name,evalWindow){var objInfo=findFormAndElement(name,evalWindow);
 return objInfo.formName;}
function findFormAndElementName(name,evalWindow){var aryNames=new Array(3);var objInfo=findFormAndElement(name,evalWindow);
 aryNames[0]=objInfo.formName;aryNames[1]=objInfo.elemName;aryNames[2]=objInfo.evalDocument;
 return aryNames;}
function findFormAndElement(name,evalWindow){var objInfo={evalDocument:"document",formName:"",objForm:null,elemName:"",objElem:null}
;var aryNames=splitFormAndElementName(name);objInfo.formName=aryNames[0];objInfo.elemName=aryNames[1];
 var objDoc=findDocument(objInfo.evalDocument,evalWindow);findFormAndElementInfo(objDoc,objInfo);
 return objInfo;}
function findFormAndElementInfo(objDoc,objInfo){var bFound=false;var formName=objInfo.formName;
 var elemName=objInfo.elemName;var foundForm=null;var foundElem=null;if (objDoc && objDoc.forms && elemName){
 var aForm;var anElem;if (formName){aForm=findFormByName(objDoc,formName);if (aForm){
 anElem=findElementByName(aForm,elemName);if (anElem){foundForm=aForm;foundElem=anElem;
 bFound=true;} } if (!foundForm){elemName=formName +"." + elemName;formName="";} }
 if (!foundForm){var aryFoundFormNames=new Array();for (var i=0;i < objDoc.forms.length;
 i++){aForm=objDoc.forms[i];anElem=findElementByName(aForm,elemName);if (anElem){
 var formName=aForm.name;if (!formName){formName=i +"";} if (!foundForm){foundForm=aForm;
 } if (!foundElem){foundElem=anElem;} aryFoundFormNames[aryFoundFormNames.length]=formName;
 bFound=true;} } if (aryFoundFormNames.length > 1){var sMsg="Ambiguous element name: " + elemName +"\n" +"Please specify a form name: " + aryFoundFormNames.toString() +"\n" +"Example: " + formName +"." + elemName +"\n";
 alert(sMsg);} } } if (bFound){objInfo.formName=formName;objInfo.elemName=elemName;
 objInfo.objForm=foundForm;objInfo.objElem=foundElem;} else if (objDoc && objDoc.layers){
 for (var i=0;i < objDoc.layers.length;i++){bFound=findFormAndElementInfo(objDoc.layers[i].document,objInfo);
 if (bFound){objInfo.evalDocument="document.layers[" + i +"]." + objInfo.evalDocument;
 break;} } } return bFound;}
function findFormByName(objDoc,formName){for (var i=0;i < objDoc.forms.length;i++){
 if (objDoc.forms[i].name==formName){return objDoc.forms[i];} } return objDoc.forms[formName];
}
function findElementByName(objForm,elemName){for (var i=0;i < objForm.elements.length;
 i++){if (objForm.elements[i].name==elemName){return objForm.elements[i];} } return objForm.elements[elemName];
}
function splitFormAndElementName(name){var aryNames=new Array(2);var i=name.indexOf(".");
 if (-1==i){aryNames[0]="";aryNames[1]=name;} else{aryNames[0]=name.substring(0,i);
 aryNames[1]=name.substring(i + 1);} return aryNames;}
var g_eWebEditProCookie_Count=0;function eWebEditProCookie(name,evalDocument,evalWindow){
 if (name){this.name=name;} else{this.name="cookie" + g_eWebEditProCookie_Count++;
 } this.evalDocument=evalDocument;this.evalWindow=evalWindow;this.expiresInSeconds=3 * 365 * 24 * 60 * 60;
 this.setCookie=eWebEditProCookie_setCookie;this.getCookie=eWebEditProCookie_getCookie;
 this.removeCookie=eWebEditProCookie_removeCookie;}
function eWebEditProCookie_setCookie(args){var expDateDefault=new Date();expDateDefault.setTime(expDateDefault.getTime() + this.expiresInSeconds * 1000);
 var argv=this.setCookie.arguments;var argc=this.setCookie.arguments.length;var name="";
 var value="";if (argc==1){name=this.name;value=argv[0];} else if (argc==2){name=argv[0];
 value=argv[1];} var expires=(argc > 2) ? argv[2] : expDateDefault;var path=(argc > 3) ? argv[3] : null;
 var domain=(argc > 4) ? argv[4] : null;var secure=(argc > 5) ? argv[5] : false;if ("object"==typeof expires){
 expires=expires.toGMTString();} var objDoc=findDocument(this.evalDocument,this.evalWindow);
 objDoc.cookie=name +"=" + escape(value) + (expires ?"; expires=" + expires :"") + (path ?"; path=" + path :"") + (domain ?"; domain=" + domain :"") + (secure ?"; secure" :"");
}
function eWebEditProCookie_getCookie(name){if (!name){name=this.name;} var objDoc=findDocument(this.evalDocument,this.evalWindow);
 var strCookie=objDoc.cookie +"";var aryPairs=strCookie.split(";");var pair=[];for (var i=0;
 i < aryPairs.length;i++){pair=aryPairs[i].split("=");if (pair.length==2){if (pair[0]==name){
 return unescape(pair[1]);} } } return;}
function eWebEditProCookie_removeCookie(name){if (!name){name=this.name;} var expDate=new Date();
 expDate.setTime(expDate.getTime() - 1);var objDoc=findDocument(this.evalDocument,this.evalWindow);
 objDoc.cookie=name +"=; expires=" + expDate.toGMTString();}
EWEP_STATUS_INSTALLED="installed";EWEP_STATUS_NOTLOADED="notloaded";EWEP_STATUS_LOADING="loading";
EWEP_STATUS_LOADED="loaded";EWEP_STATUS_SAVING="saving";EWEP_STATUS_SAVED="saved";
EWEP_STATUS_NOTSUPPORTED="notsupported";EWEP_STATUS_NOTINSTALLED="notinstalled";EWEP_STATUS_FATALERROR="fatalerror";
EWEP_STATUS_UNABLETOSAVE="unabletosave";EWEP_STATUS_SIZEEXCEEDED="sizeexceeded";EWEP_STATUS_MISSINGNOTIFY="missingnotify";
EWEP_STATUS_CANCELED="canceled";g_ewepInstanceTypes=new Array();function eWebEditProAddInstanceType(fnInstanceType){
 if ("function"==typeof fnInstanceType){g_ewepInstanceTypes[g_ewepInstanceTypes.length]=fnInstanceType;
 if ("object"==typeof eWebEditPro){eWebEditPro.addInstanceType(fnInstanceType);} }
 else{alert("eWebEditProAddInstanceType argument must be a function.\nIt is " + typeof fnInstanceType);
 }}
function eWebEditProInstanceType(){this.description="";this.type="unknown";this.parameterPropertyNames=[];
 this.refreshStatus=eWebEditProInstanceType_refreshStatus;this.valid=eWebEditProInstanceType_valid;
 this.currentPreference=eWebEditProInstanceType_currentPreference;this.create=eWebEditProInstanceType_create;
 this.clear=eWebEditProInstanceType_clear;this.fixDimension=eWebEditProInstanceType_fixDimension;
}
function eWebEditProInstanceType_refreshStatus(parameters){this.isSupported=false;
 this.isAutoInstallSupported=false;this.isInstalled=false;this.upgradeNeeded=false;
 }
function eWebEditProInstanceType_valid(){return (this.isSupported && (this.isInstalled || this.isAutoInstallSupported));
}
function eWebEditProInstanceType_currentPreference(width,height,parameters){return 0;
}
function eWebEditProInstanceType_create(name,width,height,parameters){return null;
}
function eWebEditProInstanceType_clear(){}
function eWebEditProInstanceType_fixDimension(dimension){var newDimension=dimension;
 if ("string"==typeof dimension){if (dimension.indexOf("%") >=0){newDimension=600;
 } } return newDimension;}
function eWebEditProInstance(name,width,height,parameters){if (typeof parameters !="object" || (null==parameters)){
 parameters=eWebEditPro.parameters;} extendObject(this,JSEventModel);this.id="ewep" + name;
 this.name="" + name;this.width=width;this.height=height;this.editor=null;this.asyncActive=false;
 this.receivedEvent=false;extendObject(this,AsyncMethods);this.editorDocument=parameters.getEditorDocument();
 this.editorWindow=parameters.editorWindow;this.maxContentSize=parameters.maxContentSize;
 this.isSizeExceeded=eWebEditProInstance_isSizeExceeded;this.linkTo=eWebEditProInstance_linkTo;
 this.linkedElement=eWebEditProInstance_linkedElement;this.linkedWindow=eWebEditProInstance_linkedWindow;
 this.linkedInstance=eWebEditProInstance_linkedInstance;this.linkedPopup=eWebEditProInstance_linkedPopup;
 this.isInstance=eWebEditProInstance_isInstance;this.writeHTML=eWebEditProInstance_writeHTML;
 if (typeof cSETMETHOD !="undefined"){this.editorSetMethod=cSETMETHOD;} if (!parameters.editorGetMethod){
 if (typeof cGETMETHOD !="undefined"){this.editorGetMethod=cGETMETHOD;} } else{this.editorGetMethod=parameters.editorGetMethod;
 } this.writeValue=eWebEditProInstance_writeValue;this.readValue=eWebEditProInstance_readValue;
 this.estimateContentSize=eWebEditProInstance_estimateContentSize;this.raiseSizeExceededError=eWebEditProInstance_raiseSizeExceededError;
 this.load=eWebEditProInstance_load;this.save=eWebEditProInstance_save;this.clear=eWebEditProInstance_clear;
 this.focus=eWebEditProInstance_focus;this.getReadOnly=eWebEditProInstance_getReadOnly;
 this.setReadOnly=eWebEditProInstance_setReadOnly;this.isChanged=eWebEditProInstance_isChanged;
 this.insertMediaFile=eWebEditProInstance_insertMediaFile;this.insertMediaFileDeferred=eWebEditProInstance_insertMediaFileDeferred;
 this.status=EWEP_STATUS_NOTLOADED;this.html="";if (parameters.linkToName && parameters.linkToWindow){
 this.linkTo(parameters.linkToName,parameters.linkToWindow);} else{this.linkTo(this.name,this.editorWindow);
 }}
 function eWebEditProInstance_writeHTML(strHTML,parameters){if (strHTML.length > 0){
 if (parameters.showPluginElement || parameters.showActiveXElement){strHTML='<textarea rows="10" cols="60">' + strHTML +'</textarea><br>' + strHTML;
 } conditional_write(strHTML,this,parameters);}}
function eWebEditProInstance_getReadOnly(){if (this.isReady()){if ("string"==typeof cREADONLY){
 return this.editor.getPropertyBoolean(cREADONLY);} else{return false;} } else{return false;
 }}
function eWebEditProInstance_setReadOnly(bValue){if (this.isReady()){if ("string"==typeof cREADONLY){
 this.editor.setProperty(cREADONLY,bValue);} }}
function eWebEditProInstance_isChanged(){if (this.isReady()){if ("string"==typeof cCHANGEDMETHOD){
 return eval('this.editor.' + cCHANGEDMETHOD);} else{return true;} } else{return false;
 }}
function eWebEditProInstance_writeValue(strValue,fnNotify){eval('this.editor.' + this.editorSetMethod +'(strValue)');
 notifyObject(this,fnNotify);}
function eWebEditProInstance_readValue(fnNotify){var vResult=eval('this.editor.' + this.editorGetMethod +'()');
 notifyObject(this,fnNotify,vResult);}
function eWebEditProInstance_estimateContentSize(editorEstimateContentSize){var nContentSize=0;
 if ("string"==typeof editorEstimateContentSize && editorEstimateContentSize){nContentSize=this.editor.EstimateContentSize(editorEstimateContentSize);
 } return nContentSize;}
function eWebEditProInstance_load(valueSource,objNotify,fnNotify){if (2==arguments.length || 4 <=arguments.length){
 alert("Incorrect number of arguments for eWebEditPro.Instance.load method.");return false;
 } var bReturnValue=(EWEP_STATUS_LOADED==this.status);if (this.isReady()){this.initEvent("onbeforeload");
 if (this.raiseEvent("onbeforeload") !=false){this.status=EWEP_STATUS_LOADING;bReturnValue=(EWEP_STATUS_LOADED==this.status);
 var strValue="";switch (typeof valueSource){case"undefined": case"function": var objElem=this.linkedElement();
 if (objElem){strValue=objElem.value;} else{this.linkTo(null);strValue="";} break;
 case"object": if (typeof valueSource.value !="undefined"){strValue=valueSource.value;
 } else if (valueSource){strValue=valueSource.toString();} else{strValue="";} break;
 case"string": strValue=valueSource;break;default: strValue="";} this.writeValue(strValue,function (){
 this.status=EWEP_STATUS_LOADED;this.initEvent("onload");this.raiseEvent("onload");
 bReturnValue=(EWEP_STATUS_LOADED==this.status);bReturnValue=notifyObject(objNotify,fnNotify,bReturnValue);
 return bReturnValue;});return bReturnValue;} } else{this.status=EWEP_STATUS_NOTLOADED;
 } bReturnValue=(EWEP_STATUS_LOADED==this.status);return bReturnValue;}
function eWebEditProInstance_save(objValueDestination,objNotify,fnNotify){if (2==arguments.length || 4 <=arguments.length){
 alert("Incorrect number of arguments for eWebEditPro.Instance.save method.");return false;
 } var bReturnValue=true;if (this.isReady()){if (this.asyncActive && !fnNotify){this.status=EWEP_STATUS_MISSINGNOTIFY;
 this.initEvent("onerror");this.event.source="save";if (this.raiseEvent("onerror") !=false){
 alert("eWebEditPro.Instance.save method requires a notify function.");} bReturnValue=false;
 return bReturnValue;} if ("undefined"==typeof objValueDestination || this.linkedElement==objValueDestination){
 var objElem=this.linkedElement();if (objElem){objValueDestination=objElem;} else{
 if (this.linkName){this.status=EWEP_STATUS_UNABLETOSAVE;this.initEvent("onerror");
 this.event.source="save";if (this.raiseEvent("onerror") !=false){if (eWebEditProMessages.saveFailed){
 bReturnValue=confirm(eWebEditProMessages.saveFailed);} } } bReturnValue=notifyObject(objNotify,fnNotify,bReturnValue);
 return bReturnValue;} } else if (typeof objValueDestination !="object"){alert("ERROR: Argument must be an object.");
 } if (typeof objValueDestination=="object" && objValueDestination){this.initEvent("onbeforesave");
 if (this.raiseEvent("onbeforesave") !=false){this.status=EWEP_STATUS_SAVING;var nContentSize=0;
 var bSizeExceeded=false;if ("string"==typeof editorEstimateContentSize && editorEstimateContentSize){
 nContentSize=this.estimateContentSize(editorEstimateContentSize);bSizeExceeded=this.isSizeExceeded(nContentSize);
 } if (!bSizeExceeded){bReturnValue=false;this.readValue(function (sContent){nContentSize=sContent.length;
 bSizeExceeded=this.isSizeExceeded(nContentSize);if (!bSizeExceeded){objValueDestination.value=sContent;
 var objPopup=this.linkedPopup();if (objPopup){objPopup.changed=true;} this.status=EWEP_STATUS_SAVED;
 this.initEvent("onsave");bReturnValue=(this.raiseEvent("onsave") !=false);} else{
 this.raiseSizeExceededError(nContentSize);bReturnValue=false;} bReturnValue=notifyObject(objNotify,fnNotify,bReturnValue);
 return bReturnValue;});return bReturnValue;} else{this.raiseSizeExceededError(nContentSize);
 bReturnValue=false;} } else{if (EWEP_STATUS_CANCELED==this.status || EWEP_STATUS_SIZEEXCEEDED==this.status){
 bReturnValue=false;} } } } else{this.status=EWEP_STATUS_NOTINSTALLED;} return bReturnValue;
 }
function eWebEditProInstance_raiseSizeExceededError(nContentSize){this.status=EWEP_STATUS_SIZEEXCEEDED;
 this.initEvent("onerror");this.event.source="save";this.event.contentSize=nContentSize;
 this.event.maxContentSize=this.maxContentSize;if (this.raiseEvent("onerror") !=false){
 if (eWebEditProMessages.sizeExceeded){alert(eWebEditProMessages.sizeExceeded);} }
}
function eWebEditProInstance_clear(){this.editor=null;this.receivedEvent=false;this.status=EWEP_STATUS_NOTLOADED;
}
function eWebEditProInstance_focus(){if (this.isReady()){this.editor.focus();}}
function eWebEditProInstance_isSizeExceeded(size){var bIsSizeExceeded=false;if (this.maxContentSize > 0){
 bIsSizeExceeded=(size > this.maxContentSize);} return bIsSizeExceeded;}
function eWebEditProInstance_linkTo(name,evalWindow){this.linkName=name;this.formName="";
 this.elemName="";this.evalDocument="document";this.evalWindow=evalWindow;}
function eWebEditProInstance_linkedElement(){var objElem=null;if (this.linkName && !this.elemName && !this.formName){
 var aryNames=findFormAndElementName(this.linkName,this.evalWindow);this.formName=aryNames[0];
 this.elemName=aryNames[1];this.evalDocument=aryNames[2];} if (this.formName && this.elemName){
 var objDoc=findDocument(this.evalDocument,this.evalWindow);if (objDoc){var objForm=findFormByName(objDoc,this.formName);
 if (objForm){objElem=findElementByName(objForm,this.elemName);} } } return objElem;
}
function eWebEditProInstance_linkedWindow(){return findWindow(this.evalWindow);}
function eWebEditProInstance_linkedInstance(){var objInstance=null;var objWin=this.linkedWindow();
 if (objWin && objWin.eWebEditPro){objInstance=objWin.eWebEditPro.instances[this.linkName];
 } return objInstance;}
function eWebEditProInstance_linkedPopup(){var objPopup=null;var objWin=this.linkedWindow();
 if (objWin && objWin.eWebEditPro){objPopup=objWin.eWebEditPro.popups[this.linkName];
 } return objPopup;}
function eWebEditProInstance_isInstance(objField){if (!objField) return false;var strFieldName=objField.name;
 return (this.name==strFieldName || this.id==strFieldName);}
function eWebEditProInstance_insertMediaFile(strSrcFileLocation,bLocalFile,strFileTitle,strFileType,nWidth,nHeight){
 setTimeout('eWebEditPro.instances["' + this.name +'"].insertMediaFileDeferred(' + toLiteral(strSrcFileLocation) +', ' + bLocalFile +', ' + toLiteral(strFileTitle) +', ' + toLiteral(strFileType) +', ' + nWidth +', ' + nHeight +')',1);
}
function eWebEditProInstance_insertMediaFileDeferred(strSrcFileLocation,bLocalFile,strFileTitle,strFileType,nWidth,nHeight){
 var objMedia=this.editor.MediaFile();objMedia.setProperty("IsLocal",bLocalFile);
 objMedia.setProperty("SrcFileLocationName",strSrcFileLocation);objMedia.setProperty("FileTitle",strFileTitle);
 objMedia.setProperty("FileType","IMAGE");objMedia.setProperty("ImageWidth",nWidth);
 objMedia.setProperty("ImageHeight",nHeight);this.editor.ExecCommand("cmdmfuinsert",strSrcFileLocation,bLocalFile);
}
function AsyncMethods(){this.asyncCallMethod=AsyncMethods_asyncCallMethod;this.asyncSetProperty=AsyncMethods_asyncSetProperty;
 this.asyncGetProperty=AsyncMethods_asyncGetProperty;this.asyncGetPropertyString=AsyncMethods_asyncGetPropertyString;
 this.asyncGetPropertyInteger=AsyncMethods_asyncGetPropertyInteger;this.asyncGetPropertyBoolean=AsyncMethods_asyncGetPropertyBoolean;
 this.validAsyncArguments=AsyncMethods_validAsyncArguments;this.localCall=AsyncMethods_localCall;
 }
function AsyncMethods_asyncCallMethod(methodName,argv,objNotify,fnNotify){return this.localCall(methodName,argv,objNotify,fnNotify);
}
function AsyncMethods_asyncSetProperty(propertyName,value,objNotify,fnNotify){var methodName="setProperty";
 var argv=[propertyName,value];return this.localCall(methodName,argv,objNotify,fnNotify);
}
function AsyncMethods_asyncGetProperty(propertyName,objNotify,fnNotify){var methodName="getProperty";
 var argv=[propertyName];return this.localCall(methodName,argv,objNotify,fnNotify);
}
function AsyncMethods_asyncGetPropertyString(propertyName,objNotify,fnNotify){var methodName="getPropertyString";
 var argv=[propertyName];return this.localCall(methodName,argv,objNotify,fnNotify);
}
function AsyncMethods_asyncGetPropertyInteger(propertyName,objNotify,fnNotify){var methodName="getPropertyInteger";
 var argv=[propertyName];return this.localCall(methodName,argv,objNotify,fnNotify);
}
function AsyncMethods_asyncGetPropertyBoolean(propertyName,objNotify,fnNotify){var methodName="getPropertyBoolean";
 var argv=[propertyName];return this.localCall(methodName,argv,objNotify,fnNotify);
}
function AsyncMethods_validAsyncArguments(methodName,argv,objNotify,fnNotify){var strErrorMsg="Error in asynchronous call.\n";
 if (!methodName){alert(strErrorMsg +"The name of the method to call is missing.");
 return false;} if (typeof argv !="object" || typeof argv.length !="number"){alert(strErrorMsg +"The method arguments must be passed as an array.");
 return false;} if (typeof objNotify !="object"){alert(strErrorMsg +"The objNotify argument must be an object or 'null'.");
 return false;} if (typeof fnNotify !="function"){alert(strErrorMsg +"The fnNotify argument must be a function.");
 return false;} return true;}
function AsyncMethods_localCall(methodName,argv,objNotify,fnNotify){if (!this.validAsyncArguments(methodName,argv,objNotify,fnNotify)){
 return false;} var sCode=methodName +"(";for (var i=0;i < argv.length;i++){if (i !=0){
 sCode +=", ";} sCode +=toLiteral(argv[i]);} sCode +=")";var result=eval("this.editor." + sCode);
 notifyObject(objNotify,fnNotify,result);return true;}
function eWebEditProTextareaType(){extendObject(this,eWebEditProInstanceType);this.description="Standard HTML textarea field.";
 this.type="textarea";this.parameterPropertyNames=["textareaAttributes","rows","cols"];
 this.refreshStatus=eWebEditProTextareaType_refreshStatus;this.currentPreference=eWebEditProTextareaType_currentPreference;
 this.create=eWebEditProTextareaType_create;}
eWebEditProAddInstanceType(eWebEditProTextareaType);function eWebEditProTextareaType_refreshStatus(parameters){
 this.isSupported=true;this.isAutoInstallSupported=false;this.isInstalled=true;this.upgradeNeeded=false;
 }
function eWebEditProTextareaType_currentPreference(width,height,parameters){return 1;
}
function eWebEditProTextareaType_create(name,width,height,parameters){var objInstance=new eWebEditProTextarea(name,width,height,parameters);
 return objInstance;}
function eWebEditProTextarea(name,width,height,parameters){if (typeof parameters !="object" || (null==parameters)){
 parameters=eWebEditPro.parameters;} this.type="textarea";extendObject(this,eWebEditProInstance,name,width,height,parameters);
 this.editElement=null;this.createHTML=eWebEditProTextarea_createHTML;this.isReady=eWebEditProTextarea_isReady;
 this.writeValue=eWebEditProTextarea_writeValue;this.readValue=eWebEditProTextarea_readValue;
 this.estimateContentSize=eWebEditProTextarea_estimateContentSize;this.clear=eWebEditProTextarea_clear;
 this.focus=eWebEditProTextarea_focus;this.getReadOnly=eWebEditProTextarea_getReadOnly;
 this.setReadOnly=eWebEditProTextarea_setReadOnly;this.isChanged=eWebEditProTextarea_isChanged;
 this.insertMediaFile=new Function();var strHTML=this.createHTML(parameters);this.writeHTML(strHTML,parameters);
}
 function eWebEditProTextarea_createHTML(parameters){var numCols;var numRows;if (parameters.cols){
 numCols=parameters.cols;} else if (typeof this.width=="number"){numCols=Math.round(this.width/ 9);
 } else{numCols=60;} if (parameters.rows){numRows=parameters.rows;} else if (typeof this.height=="number"){
 numRows=Math.round(this.height/ 18);} else{numRows=20;} var sHtml='<textarea name="' + this.id +'" cols="' + numCols +'" rows="' + numRows +'"';
 if (parameters.readOnly){sHtml +=' readonly="readonly"';} if (parameters.textareaAttributes){
 sHtml +=' ' + parameters.textareaAttributes;} sHtml +='></textarea>';return sHtml;
}
function eWebEditProTextarea_isReady(){if (("undefined"==typeof this.editElement) || (null==this.editElement)){
 this.editElement=findElement(this.id,this.editorWindow);} return (("undefined" !=typeof this.editElement) && (null !=this.editElement));
}
function eWebEditProTextarea_getReadOnly(){if (this.isReady()){return this.editElement.readOnly;
 } else{return false;}}
function eWebEditProTextarea_setReadOnly(bValue){if (this.isReady()){this.editElement.readOnly=bValue;
 }}
function eWebEditProTextarea_isChanged(){if (this.isReady()){var objElem=this.linkedElement();
 if (objElem){return (this.editElement.value !=objElem.value);} else{return false;
 } } else{return false;}}
function eWebEditProTextarea_writeValue(strValue,fnNotify){this.editElement.value=strValue;
 notifyObject(this,fnNotify);}
function eWebEditProTextarea_readValue(fnNotify){var vResult=this.editElement.value;
 notifyObject(this,fnNotify,vResult);}
function eWebEditProTextarea_estimateContentSize(editorEstimateContentSize){var nContentSize=this.editElement.value.length;
 return nContentSize;}
function eWebEditProTextarea_clear(){if (this.isReady()){this.editElement.value="";
 } this.editElement=null;this.status=EWEP_STATUS_NOTLOADED;}
function eWebEditProTextarea_focus(){if (this.isReady()){this.editElement.focus();
 }}
function FlashElement(){extendObject(this,PlatformInfo);this.isSupported=false;this.isAutoInstallSupported=false;
 this.isInstalled=true;this.isLiveConnectSupported=false;if ((this.isWindows) && (this.isIE && this.browserVersion >=4.0)){
 this.isSupported=true;this.isLiveConnectSupported=true;extendObject(this,FlashObjectElem);
 } else if (this.isIE && this.browserVersion >=4.0){this.isSupported=true;extendObject(this,FlashEmbedElem);
 } else if ((this.isNetscape && this.browserVersion >=4.7)){if (this.browserVersion >=6.2){
 this.isSupported=true;extendObject(this,FlashEmbedElem);} else if (this.browserVersion < 6.0){
 this.isSupported=true;extendObject(this,FlashEmbedElem);} } else if ((this.isWindows) && (this.isOpera && this.browserVersion >=6)){
 this.isSupported=true;extendObject(this,FlashEmbedElem);} else if ((this.isMac) && (this.isOpera && this.browserVersion >=5)){
 this.isSupported=true;extendObject(this,FlashEmbedElem);}}
 function FlashObjectElem(){extendObject(this,PluginElement,"object");this.createBeforeHTML=this.createEventsHTML;
 this.createAfterHTML=null;}
function FlashEmbedElem(){extendObject(this,PluginElement,"embed");this.createBeforeHTML=this.createEventsHTML;
 this.createAfterHTML=null;}
var cFLASHCLASSID="D27CDB6E-AE6D-11cf-96B8-444553540000";var cFLASHCODEBASE="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,47,0";
var cFLASHMIMETYPE="application/x-shockwave-flash";var cFLASHPLUGINSPAGE="http://www.macromedia.com/go/getflashplayer";
var cFLASHSRC=eWebWPPath +"ewebwp.swf";function eWebEditProFlashType(){extendObject(this,eWebEditProInstanceType);
 this.description="Macromedia Flash MX";this.type="flash";this.parameterPropertyNames=["objectAttributes","embedAttributes","filtering","disableIcons","defaultFontName","defaultFontSize","defaultFontColor","customSaveIcon","removeFont","asXHTML"];
 this.numInstances=0;this.isMac=false;this.refreshStatus=eWebEditProFlashType_refreshStatus;
 this.overrideMethod("valid",eWebEditProFlashType_valid);this.currentPreference=eWebEditProFlashType_currentPreference;
 this.create=eWebEditProFlashType_create;this.clear=eWebEditProFlashType_clear;}
eWebEditProAddInstanceType(eWebEditProFlashType);function eWebEditProFlashType_refreshStatus(parameters){
 if (typeof parameters !="object" || (null==parameters)){parameters=eWebEditPro.parameters;
 } var objPluginElement=new FlashElement();this.isSupported=objPluginElement.isSupported;
 this.isAutoInstallSupported=objPluginElement.isAutoInstallSupported;this.isInstalled=objPluginElement.isInstalled;
 this.versionInstalled=objPluginElement.versionInstalled;this.upgradeNeeded=false;
 this.isMac=objPluginElement.isMac;objPluginElement=null;}
function eWebEditProFlashType_valid(){if (this.numInstances >=1){return false;} return (this.super_valid());
}
function eWebEditProFlashType_currentPreference(width,height,parameters){if (this.numInstances >=1){
 return 0;} return 275;}
function eWebEditProFlashType_create(name,width,height,parameters){var objInstance=new eWebEditProFlash(name,width,height,parameters);
 this.numInstances++;return objInstance;}
function eWebEditProFlashType_clear(){this.numInstances=0;}
function eWebEditProFlash(name,width,height,parameters){if (typeof parameters !="object" || (null==parameters)){
 parameters=eWebEditPro.parameters;} this.type="flash";var wd=width * 1;var ht=height * 1;
 if (wd < 1){width=550;} if (ht < 1){height=400;} extendObject(this,eWebEditProInstance,name,width,height,parameters);
 this.createHTML=eWebEditProFlash_createHTML;this.isReady=eWebEditProFlash_isReady;
 this.writeValue=eWebEditProFlash_writeValue;this.readValue=eWebEditProFlash_readValue;
 this.estimateContentSize=eWebEditProFlash_estimateContentSize;this.clear=eWebEditProFlash_clear;
 this.focus=eWebEditProFlash_focus;this.getReadOnly=eWebEditProFlash_getReadOnly;
 this.setReadOnly=eWebEditProFlash_setReadOnly;this.isChanged=eWebEditProFlash_isChanged;
 this.valueFromFlash=null;this.convertToFlash=eWebEditProFlash_convertToFlash;this.convertFromFlash=eWebEditProFlash_convertFromFlash;
 var strHTML=this.createHTML(parameters);this.writeHTML(strHTML,parameters);}
 function eWebEditProFlash_createHTML(parameters){var sHtml="";var objPluginElement=new FlashElement();
 this.isIE=objPluginElement.isIE;this.isNetscape=objPluginElement.isNetscape;this.browserVersion=objPluginElement.browserVersion;
 this.isSupported=objPluginElement.isSupported;this.isInstalled=objPluginElement.isInstalled;
 this.isWindows=objPluginElement.isWindows;this.isMac=objPluginElement.isMac;this.isOpera=objPluginElement.isOpera;
 this.isLiveConnectSupported=objPluginElement.isLiveConnectSupported;if (this.isSupported){
 if (!objPluginElement.isInstalled && !objPluginElement.isAutoInstallSupported){this.status=EWEP_STATUS_NOTINSTALLED;
 } objPluginElement.copyHTMLAttributes(this);if (parameters["embedAttributes"]){objPluginElement.embedAttributes=parameters.embedAttributes;
 } if (parameters["objectAttributes"]){objPluginElement.objectAttributes=parameters.objectAttributes;
 } if (cFLASHCLASSID){objPluginElement.classid=cFLASHCLASSID;} if (cFLASHCODEBASE){
 objPluginElement.codebase=cFLASHCODEBASE;} if (cFLASHMIMETYPE){objPluginElement.mimetype=cFLASHMIMETYPE;
 } if (cFLASHPLUGINSPAGE){objPluginElement.pluginspage=cFLASHPLUGINSPAGE;} if (cFLASHSRC){
 objPluginElement.defineParam("src",cFLASHSRC);} objPluginElement.defineEvent("flashsubmit()",'var objForm = findElementForm("' + this.name +'", eWebEditPro.instances["' + this.name +'"].evalWindow);var bToSubmit = (objForm!=null);if(bToSubmit)for (var i = 0; i < objForm.elements.length; i++){if ("submit" == objForm.elements[i].type || "image" == objForm.elements[i].type){bToSubmit = false;break;}}if(true == bToSubmit && true == '+ toIdentifier(this.name) +'_onsubmit()){objForm.submit();}else if(null == objForm){top.close();}');
 if (this.isLiveConnectSupported){objPluginElement.defineEvent("flashsavevar()",'eWebEditPro.save();'+ toIdentifier(this.name) +'_flashsubmit();');
 } else{objPluginElement.defineEvent("flashsavecontent(strContent)",'eWebEditPro.instances["' + this.name +'"].valueFromFlash = strContent + "";eWebEditPro.save();'+ toIdentifier(this.name) +'_flashsubmit();');
 } objPluginElement.defineEvent("flashwin(strURL)",'window.open(strURL,\"newwin\",\"resizable=yes,scrollbars=yes,status=yes,width=600,height=400\");');
 var strFlashVars="";var strEditorMode="FS";var bFilterFlashVar=true;if (this.isLiveConnectSupported){
 strEditorMode="SG";bFilterFlashVar=false;} if (this.isWindows && (this.isIE && this.browserVersion < 5.0)){
 strEditorMode=strEditorMode +"R";} else if (this.isWindows && (this.isNetscape && this.browserVersion >=7.0)){
 strEditorMode=strEditorMode +"R";} else{strEditorMode=strEditorMode +"N";} strFlashVars +="mode=" + strEditorMode;
 strFlashVars +="&instanceName=" + toIdentifier(this.name);if (parameters["license"]){
 strFlashVars +="&license=" + parameters["license"];} if (parameters.filtering){strFlashVars +="&filtering=" + parameters.filtering;
 } else{strFlashVars +="&filtering=E";} if (parameters.disableIcons){strFlashVars +="&disableicons=" + parameters.disableIcons;
 } if (parameters.defaultFontName){strFlashVars +="&defaultfontname=" + parameters.defaultFontName;
 } if (parameters.defaultFontSize){strFlashVars +="&defaultfontsize=" + parameters.defaultFontSize;
 } if (parameters.defaultFontColor){strFlashVars +="&defaultfontcolor=" + parameters.defaultFontColor;
 } if (parameters.customSaveIcon){strFlashVars +="&customsaveicon=" + parameters.customSaveIcon;
 } this.bRemoveFont=false;if (parameters.removeFont){this.bRemoveFont=parameters.removeFont;
 strFlashVars +="&removeFont=" + this.bRemoveFont;} this.isXHTML=false;if (parameters.asXHTML){
 this.isXHTML=parameters.asXHTML;strFlashVars +="&asXHTML=" + this.isXHTML;} var strContent="";
 var objElement=this.linkedElement();if (objElement && true==bFilterFlashVar){strContent=this.convertToFlash(objElement.value);
 } if (! this.isLiveConnectSupported){strFlashVars +="&content=" + escape(strContent);
 } objPluginElement.defineParam("FlashVars",strFlashVars);objPluginElement.defineNamedEvents(parameters);
 objPluginElement.defineParam("bgcolor","#d4d0c8");sHtml +=objPluginElement.createHTML();
 } else{this.status=EWEP_STATUS_NOTSUPPORTED;} objPluginElement=null;return sHtml;
}
function eWebEditProFlash_isReady(){var isReady=false;if (("undefined"==typeof this.flasheditor) || (null==this.flasheditor)){
 var id=this.id;if (this.isIE && this.isWindows){var evalWindowDocument="";if (this.editorWindow){
 evalWindowDocument=this.editorWindow +".";} evalWindowDocument +=this.editorDocument;
 this.flasheditor=eval(evalWindowDocument)[id];} else if (this.isNetscape && this.isWindows){
 var evalWindowDocument="";if (this.editorWindow){evalWindowDocument=this.editorWindow +".";
 } evalWindowDocument +=this.editorDocument;this.flasheditor=eval(evalWindowDocument)[id];
 } else{this.flasheditor=null;} } if ((typeof this.flasheditor !="undefined") && (this.flasheditor !=null)){
 if (this.isIE && this.browserVersion < 5.0){if (this.receivedEvent){isReady=true;
 } else{isReady=false;} } else if (this.isNetscape && this.browserVersion >=7.0){
 if (this.receivedEvent){isReady=true;} else{isReady=false;} } else{isReady=(typeof this.flasheditor.SetVariable !="undefined");
 } } else if (! this.isLiveConnectSupported){isReady=true;} else{isReady=false;} return isReady;
}
function eWebEditProFlash_writeValue(strValue,fnNotify){if (this.isLiveConnectSupported && this.isReady()){
 strValue=this.convertToFlash(strValue);this.flasheditor.SetVariable("BodyHTML",strValue);
 } notifyObject(this,fnNotify);}
function eWebEditProFlash_readValue(fnNotify){var strValue="";if ("string"==typeof this.valueFromFlash){
 strValue=this.convertFromFlash(this.valueFromFlash);this.valueFromFlash=null;} else if (this.isLiveConnectSupported && this.isReady()){
 strValue=this.flasheditor.GetVariable("BodyHTML");strValue=this.convertFromFlash(strValue);
 } else{var objElement=this.linkedElement();if (objElement){strValue=objElement.value;
 } } notifyObject(this,fnNotify,strValue);}
function eWebEditProFlash_estimateContentSize(editorEstimateContentSize){var nContentSize=0;
 if ("string"==typeof editorEstimateContentSize && editorEstimateContentSize){} return nContentSize;
}
function eWebEditProFlash_clear(){}
 function eWebEditProFlash_focus(){if (this.isReady()){}}
 function eWebEditProFlash_getReadOnly(){if (this.isReady()){return false;} else{
 return false;}}
function eWebEditProFlash_setReadOnly(bValue){if (this.isReady()){}}
function eWebEditProFlash_isChanged(){if (this.isLiveConnectSupported && this.isReady()){
 if ("boolean"==typeof this.flasheditor.GetVariable("bChanged")){return eval(this.flasheditor.GetVariable("bChanged"));
 } else{return true;} } else{return (this.valueFromFlash !=null);}}
function eWebEditProFlash_convertToFlash(strValue){var filter=new eWebWPFlashFilter(strValue,"javascript",this.isXHTML,this.bRemoveFont);
 strValue=filter.htmlToFlash();return (strValue);}
function eWebEditProFlash_convertFromFlash(strValue){var filter=new eWebWPFlashFilter(strValue,"javascript",this.isXHTML,this.bRemoveFont);
 strValue=filter.flashToHTML();return (strValue);}
eWebWPFlashFilter=function(theString,mode,asXHTML,bRemoveFont){this.filterString=theString +"";
 this.hyperlinkClickedMethod="hyperlinkClicked";this.g_blockIndent=15;if(mode.toLowerCase()=="actionscript"){
 this.activeScript=true;} else{this.activeScript=false;} this.bXHTML=asXHTML;this.isRemoveFont=bRemoveFont;
}
eWebWPFlashFilter.prototype.htmlToFlash=function(){this.convertBqToTf();this.replaceEx("P{MARGIN:0in;MARGIN-BOTTOM:.0001pt;}BLOCKQUOTE{MARGIN-TOP:0in;MARGIN-BOTTOM:0in;}","");
 this.replaceEx("<A HREF=\"","<A HREF=\"asfunction:"+this.hyperlinkClickedMethod+",");
 this.convertImgToFlash();this.replaceEx("<UL>","");this.replaceEx("</UL>","");this.replaceEx("SIZE=\"1\"","SIZE=\"12\"");
 this.replaceEx("SIZE=\"2\"","SIZE=\"14\"");this.replaceEx("SIZE=\"3\"","SIZE=\"18\"");
 this.replaceEx("SIZE=\"4\"","SIZE=\"24\"");this.replaceEx("SIZE=\"5\"","SIZE=\"36\"");
 this.replaceEx("SIZE=\"6\"","SIZE=\"48\"");this.replaceEx("SIZE=\"7\"","SIZE=\"72\"");
 this.replaceEx("&#160;"," ");this.replaceEx("€","%u20AC");this.replaceEx("&#8364;","%u20AC");
 return (this.filterString);}
eWebWPFlashFilter.prototype.flashToHTML=function(){this.convertSymbol();this.replaceEx("&apos;","&#39;");
 this.replaceEx("%A0","&#160;");this.replaceEx("%A1","&#161;");this.replaceEx("%A2","&#162;");
 this.replaceEx("%A3","&#163;");this.replaceEx("%A4","&#164;");this.replaceEx("%A5","&#165;");
 this.replaceEx("%A6","&#166;");this.replaceEx("%A7","&#167;");this.replaceEx("%A8","&#168;");
 this.replaceEx("%A9","&#169;");this.replaceEx("%AA","&#170;");this.replaceEx("%AB","&#171;");
 this.replaceEx("%AC","&#172;");this.replaceEx("%AD","&#173;");this.replaceEx("%AE","&#174;");
 this.replaceEx("%AF","&#175;");this.replaceEx("%B0","&#176;");this.replaceEx("%B1","&#177;");
 this.replaceEx("%B2","&#178;");this.replaceEx("%B3","&#179;");this.replaceEx("%B4","&#180;");
 this.replaceEx("%B5","&#181;");this.replaceEx("%B6","&#182;");this.replaceEx("%B7","&#183;");
 this.replaceEx("%B8","&#184;");this.replaceEx("%B9","&#185;");this.replaceEx("%BA","&#186;");
 this.replaceEx("%BB","&#187;");this.replaceEx("%BC","&#188;");this.replaceEx("%BD","&#189;");
 this.replaceEx("%BE","&#190;");this.replaceEx("%BF","&#191;");this.replaceEx("%80","&#8364;");
 this.removeEmptyTags();if (this.isRemoveFont){this.removeFontTags();} this.convertTfToBq();
 this.convertListToHTML();this.convertImgToHTML();this.replaceEx("asfunction:" + this.hyperlinkClickedMethod +",","");
 this.replaceEx("TARGET=\"\"","");if (!this.isRemoveFont){this.replaceEx("SIZE=\"12\"","SIZE=\"1\"");
 this.replaceEx("SIZE=\"14\"","SIZE=\"2\"");this.replaceEx("SIZE=\"18\"","SIZE=\"3\"");
 this.replaceEx("SIZE=\"24\"","SIZE=\"4\"");this.replaceEx("SIZE=\"36\"","SIZE=\"5\"");
 this.replaceEx("SIZE=\"48\"","SIZE=\"6\"");this.replaceEx("SIZE=\"72\"","SIZE=\"7\"");
 } return (this.filterString);}
eWebWPFlashFilter.prototype.convertSymbol=function(){for( var i=161;i <=191;i++){
 this.replaceEx(String.fromCharCode(i),"&#" + new String(i) +";");} this.replaceEx(String.fromCharCode(8364),"&#" + new String(8364) +";");
 return (this.filterString);}
eWebWPFlashFilter.prototype.replaceEx=function(oldvalue,newvalue){this.filterString=this.replace(this.filterString,oldvalue,newvalue);
}
eWebWPFlashFilter.prototype.replace=function(theString,oldString,newString){var pos=0;
 while ((pos=theString.indexOf(oldString,pos)) > -1){theString=theString.substring(0,pos) + newString + theString.substring((pos + oldString.length),theString.length);
 pos=pos + newString.length;} return (theString);}
eWebWPFlashFilter.prototype.removeEmptyTags=function(){var htmlSpace="&#160;";var tags=[["<U>","</U>",""],["<I>","</I>",""],["<B>","</B>",""],["<A",">","</A>",""],["<FONT",">","</FONT>","&#160;"],["<LI>","</LI>",""]];
 for (var i=0;i<tags.length;i++){var opentagpos=0;var opentagendpos=0;var closetagpos=0;
 var tagText="";if (tags[i].length==4){while ((opentagpos=this.filterString.indexOf(tags[i][0],opentagpos)) > -1){
 if ((opentagendpos=this.filterString.indexOf(tags[i][1],opentagpos+tags[i][0].length))==-1){
 break;} if ((closetagpos=this.filterString.indexOf(tags[i][2],opentagendpos+tags[i][1].length))==-1){
 break;} tagText=this.filterString.substring(opentagendpos+tags[i][1].length,closetagpos);
 if (tagText==""){this.filterString=this.filterString.substring(0,opentagpos) + tags[i][3] + this.filterString.substring(closetagpos+tags[i][2].length,this.filterString.length);
 opentagpos=opentagpos + tags[i][3].length;} else{var tagTextLength=tagText.length;
 var newtTagTextLength=0;tagText=this.replaceMultSpaces(tagText);newTagTextLength=tagText.length;
 this.filterString=this.filterString.substring(0,opentagendpos + tags[i][1].length) + tagText+this.filterString.substring(closetagpos,this.filterString.length);
 opentagpos=opentagendpos + tags[i][1].length;} } } else if (tags[i].length==3){while ((opentagpos=this.filterString.indexOf(tags[i][0],opentagpos)) > -1){
 if ((closetagpos=this.filterString.indexOf(tags[i][1],opentagpos+tags[i][0].length))==-1){
 break;} tagText=this.filterString.substring(opentagpos + tags[i][0].length,closetagpos);
 if (tagText=="" || tagText==htmlSpace){this.filterString=this.filterString.substring(0,opentagpos) + tags[i][2] + this.filterString.substring(closetagpos + tags[i][1].length,this.filterString.length);
 opentagpos=opentagpos + tags[i][2].length;} else{var tagTextLength=tagText.length;
 var newtTagTextLength=0;tagText=this.replaceMultSpaces(tagText);newTagTextLength=tagText.length;
 this.filterString=this.filterString.substring(0,opentagpos+tags[i][0].length) + tagText + this.filterString.substring(closetagpos,this.filterString.length);
 opentagpos=opentagpos + tags[i][0].length + newTagTextLength + tags[i][1].length;
 } opentagpos=closetagpos + tags[i][1].length;} } }}
eWebWPFlashFilter.prototype.replaceMultSpaces=function(textString){var htmlSpace="&#160;";
 var beginSpaces="  ";var spaceString="";var spacepos=0;var endspacepos=0;while ((spacepos=textString.indexOf(beginSpaces,spacepos)) > -1){
 spaceString=" "+htmlSpace;endspacepos=spacepos + beginSpaces.length;while (textString.substring(endspacepos,endspacepos + 1)==" "){
 endspacepos++;spaceString=spaceString + htmlSpace;} textString=textString.substring(0,spacepos) + spaceString + textString.substring(endspacepos,textString.length);
 spacepos=0;} return (textString);}
eWebWPFlashFilter.prototype.convertTfToBq=function(){var pos=0,endpos=0;var blockIndent=this.g_blockIndent;
 var beginTag="<TEXTFORMAT BLOCKINDENT=";var beginTagEnd=">";var endTag="</TEXTFORMAT>";
 var replaceBeginTag="<BLOCKQUOTE>";var replaceEndTag="</BLOCKQUOTE>";while ((pos=this.filterString.indexOf(beginTag)) > -1){
 var firstQuote=this.filterString.indexOf("\"",pos) + 1;var secondQuote=this.filterString.indexOf("\"",firstQuote);
 var indentAmount=this.filterString.substring(firstQuote,secondQuote);var numberOfIndents=parseInt(indentAmount)/ blockIndent;
 var completeBeginTag=beginTag +"\"" + indentAmount +"\"" + beginTagEnd;var newBegin="";
 var newEnd="";for (var i=1;i <=numberOfIndents;i++){newBegin=newBegin + replaceBeginTag;
 newEnd=newEnd + replaceEndTag;} this.filterString=this.filterString.substring(0,pos) + newBegin + this.filterString.substring((pos + completeBeginTag.length),this.filterString.length);
 endpos=this.filterString.indexOf(endTag,pos);this.filterString=this.filterString.substring(0,endpos) + newEnd + this.filterString.substring((endpos + endTag.length),this.filterString.length);
 }}
eWebWPFlashFilter.prototype.convertBqToTf=function (){var pos=0,endpos=0;var blockIndent=this.g_blockIndent;
 var beginTag="<BLOCKQUOTE>";var endTag="</BLOCKQUOTE>";var replaceBeginTag="<TEXTFORMAT BLOCKINDENT=\"";
 var replaceEndTag="\">";var replaceCloseTag="</TEXTFORMAT>";var blockQuoteCount=0;
 var beginPos=0;var endPos=0;var closeBeginPos=0;var closeEndPos=0;while ((pos=this.filterString.indexOf(beginTag)) > -1){
 blockQuoteCount=1;var curpos=pos + beginTag.length;while (this.filterString.substring(curpos,curpos + beginTag.length)==beginTag){
 curpos=curpos + beginTag.length;blockQuoteCount++;} beginPos=pos;endPos=curpos;if ((closeBeginPos=this.filterString.indexOf(endTag,curpos))==-1){
 break;} closeEndPos=closeBeginPos + (blockQuoteCount * endTag.length);this.filterString=this.filterString.substring(0,beginPos) + replaceBeginTag + (blockQuoteCount * blockIndent) + replaceEndTag + this.filterString.substring(endPos,closeBeginPos) + replaceCloseTag + this.filterString.substring(closeEndPos,this.filterString.length);
 }}
eWebWPFlashFilter.prototype.convertListToHTML=function(){var beginTag="<LI>";var endTag="</LI>";
 var ULOpenTag="<UL>";var ULCloseTag="</UL>";var pos=0;var firstBeginLI=0;var lastEndLI=0;
 while ((pos=this.filterString.indexOf(beginTag,pos)) > -1){firstBeginLI=pos;lastEndLI=pos;
 while ((pos=this.filterString.indexOf(endTag,lastEndLI)) > -1){lastEndLI=pos + endTag.length;
 if (this.filterString.indexOf(beginTag,pos) !=lastEndLI){break;} } this.filterString=this.filterString.substring(0,firstBeginLI) + ULOpenTag + this.filterString.substring(firstBeginLI,lastEndLI) + ULCloseTag + this.filterString.substring(lastEndLI,this.filterString.length);
 pos=lastEndLI;}}
eWebWPFlashFilter.prototype.convertImgToFlash=function(){var pos=0;var endpos=0;var endtagpos=0;
 var imgTagBegin="<img";var imgTagEnd=">";var imgWrapTagBegin="<FONT FACE=\"Times New Roman, Times\" SIZE=\"10\" COLOR=\"0xFF0000\"><A HREF=\"asfunction:imageClicked,";
 var imgWrapTagEnd="\"><U>[";var imgWrapCloseTag="]</U></A></FONT>";var srcPropBegin="src=\"";
 var srcPropEnd="\"";while ((pos=this.filterString.indexOf(imgTagBegin)) > -1){if ((endpos=this.filterString.indexOf(imgTagEnd,pos))==-1){
 break;} else if ("/"==this.filterString.substring(endpos-1,endpos)){endpos=endpos - 1;
 imgTagEnd="/>";} var tmpString=this.filterString.substring(pos,endpos);var srcStartPos=tmpString.indexOf(srcPropBegin,0) + srcPropBegin.length;
 var srcEndPos=tmpString.indexOf(srcPropEnd,srcStartPos);var srcString=tmpString.substring(srcStartPos,srcEndPos);
 this.filterString=this.filterString.substring(0,pos) + imgWrapTagBegin + srcString + imgWrapTagEnd + this.filterString.substring(pos + 1,endpos) + imgWrapCloseTag + this.filterString.substring(endpos + imgTagEnd.length,this.filterString.length);
 }}
eWebWPFlashFilter.prototype.convertImgToHTML=function(){var pos=0;var endpos=0;var endtagpos=0;
 var imgTagBegin="[img";var imgTagEnd="]";var newImgTagBegin="<img";var newImgTagEnd=">";
 if (this.bXHTML){newImgTagEnd="/>";} var imgAncTagBegin="<A HREF=\"asfunction:imageClicked,";
 var imgAncTagEnd=">";var imgAncCloseTag="</A>";var undOpenTag="<U>";var undCloseTag="</U>";
 var fontOpenTag="<FONT ";var fontCloseTag="</FONT>";while ((pos=this.filterString.indexOf(imgTagBegin)) > -1){
 if ((endpos=this.filterString.indexOf(imgTagEnd,pos))==-1){break;} this.filterString=this.filterString.substring(0,pos) + newImgTagBegin + this.replace(this.filterString.substring(pos+imgTagBegin.length,endpos),"&quot;","\"") + newImgTagEnd + this.filterString.substring(endpos+1,this.filterString.length);
 } while ((pos=this.filterString.indexOf(imgAncTagBegin)) > -1){if ((endpos=this.filterString.indexOf(imgAncTagEnd,pos))==-1){
 break;} if ((endtagpos=this.filterString.indexOf(imgAncCloseTag,endpos))==-1){break;
 } this.filterString=this.filterString.substring(0,pos) + this.filterString.substring(endpos + 1,endtagpos) + this.filterString.substring(endtagpos + imgAncCloseTag.length,this.filterString.length);
 } pos=0;while ((pos=this.filterString.indexOf(newImgTagBegin,pos)) > -1){if ((endpos=this.filterString.indexOf(newImgTagEnd,pos))==-1){
 break;} if ((this.filterString.substring(pos - undOpenTag.length,pos)==undOpenTag) && (this.filterString.substring(endpos + 1,endpos + 1 + undCloseTag.length)==undCloseTag)){
 this.filterString=this.filterString.substring(0,pos - undOpenTag.length) + this.filterString.substring(pos,endpos) + this.filterString.substring(endpos + undCloseTag.length,this.filterString.length);
 } else{pos=endpos;} }}
eWebWPFlashFilter.prototype.removeFontTags=function(){this.replaceEx("</FONT>","");
 var tags=["<FONT",">"];var opentagpos=0;var opentagendpos=0;while ((opentagpos=this.filterString.indexOf(tags[0],opentagpos)) > -1){
 if ((opentagendpos=this.filterString.indexOf(tags[1],opentagpos+tags[0].length)) > -1){
 this.filterString=this.filterString.substring(0,opentagpos) + this.filterString.substring(opentagendpos + tags[1].length,this.filterString.length);
 } } }
function eWebEditProButtonTag(){this.type=eWebEditProDefaults.popupButtonTagType;
 this.start=eWebEditProDefaults.popupButtonTagStart;this.tagAttributes=eWebEditProDefaults.popupButtonTagTagAttributes;
 this.value=eWebEditProMessages.popupButtonCaption;this.end=eWebEditProDefaults.popupButtonTagEnd;
 this.imageTag=new eWebEditProImageTag();this.valid=eWebEditProButtonTag_valid;this.createHTML=eWebEditProButtonTag_createHTML;
 this.HTMLEncode=eWebEditProUtil_HTMLEncode;}
function eWebEditProButtonTag_valid(){return ((this.type || (this.start && this.end) || this.imageTag) &&"function"==typeof this.createHTML);
}
function eWebEditProButtonTag_createHTML(buttonName,elementName){var strHTML="";if (typeof this.tagAttributes !="string"){
 this.tagAttributes="";} switch (this.type){case"custom": strHTML +=this.start;strHTML +='eWebEditPro.edit("' + elementName +'")';
 strHTML +=this.end;break;case"image": if (this.imageTag){strHTML +=this.imageTag.createHTML(buttonName,elementName);
 } break;case"imagelink": strHTML +="<a " + this.tagAttributes +" href='javascript:eWebEditPro.edit(\"" + elementName +"\")'>";
 if (this.imageTag){strHTML +=this.imageTag.createHTML(buttonName);} strHTML +="</a>";
 break;case"hyperlink": strHTML +="<a " + this.tagAttributes +" href='javascript:eWebEditPro.edit(\"" + elementName +"\")'>";
 strHTML +=this.value;strHTML +="</a>";break;case"button": strHTML +='<button type="button" ' + this.tagAttributes;
 if (buttonName){strHTML +=' name="' + buttonName +'"';} strHTML +=' onclick=\'eWebEditPro.edit("' + elementName +'")\'>';
 if (this.value){strHTML +=this.value;} strHTML +="</button>";break;case"inputbutton": strHTML +='<input type="button" ' + this.tagAttributes;
 if (buttonName){strHTML +=' name="' + buttonName +'"';} if (this.value){strHTML +=' value="' + this.HTMLEncode(this.value) +'"';
 } strHTML +=' onclick=\'eWebEditPro.edit("' + elementName +'")\'>';break;default: strHTML +=this.start +" " + this.tagAttributes;
 if (buttonName){strHTML +=' name="' + buttonName +'"';} if (this.value){strHTML +=' value="' + this.HTMLEncode(this.value) +'"';
 } strHTML +=' onclick=\'eWebEditPro.edit("' + elementName +'")\'';strHTML +=this.end;
 break;} return strHTML;}
function eWebEditProImageTag(){this.alt=eWebEditProMessages.popupButtonCaption;this.border=0;
 var objDefaultImageTag=eWebEditProDefaults.popupButtonTagImageTag;if ("object"==typeof objDefaultImageTag){
 for (var p in objDefaultImageTag){this[p]=objDefaultImageTag[p];} } if (!this.src){
 this.src=eWebEditProDefaults.path +"btnedit.gif";} this.createHTML=eWebEditProImageTag_createHTML;
 this.HTMLEncode=eWebEditProUtil_HTMLEncode;}
function eWebEditProImageTag_createHTML(buttonName,elementName){var strHTML='<img';
 for (var p in this){var strTypeOfProp=(typeof this[p]);if ("string"==strTypeOfProp ||"number"==strTypeOfProp ||"boolean"==strTypeOfProp){
 strHTML +=' ' + p +'="' + this.HTMLEncode(this[p]) +'"';} } if (buttonName){strHTML +=' name="' + buttonName +'"';
 } if (elementName){strHTML +=' onclick=\'eWebEditPro.edit("' + elementName +'")\'';
 } strHTML +='>';return strHTML;}
function eWebEditProPopup(){extendObject(this,commonPopup);this.url=eWebEditProDefaults.popupUrl;
 this.windowName=eWebEditProDefaults.popupWindowName;this.windowFeatures=eWebEditProDefaults.popupWindowFeatures;
 this.query=eWebEditProDefaults.popupQuery;this.open=eWebEditProPopup_open;this.getInstance=eWebEditProPopup_getInstance;
}
function eWebEditProPopup_open(){if (this.url){var strUrl=this.url;if (this.elementName){
 strUrl +="?element=" + escape(this.elementName);if (this.elementWindow){strUrl +="&elementWindow=" + escape(this.elementWindow);
 } if (this.parametersName){strUrl +="&parameters=" + this.parametersName;} if (this.query){
 strUrl +="&" + this.query;} } this.objWindow=window.open(strUrl,this.windowName,this.windowFeatures);
 } else{this.objWindow=null;} return this.objWindow;}
function eWebEditProPopup_getInstance(){var objInstance=null;if (this.isOpen() && this.objWindow.eWebEditPro){
 objInstance=this.objWindow.eWebEditPro.instances[0];} return objInstance;}
function installPopup(){extendObject(this,commonPopup);this.url=eWebEditProDefaults.installPopupUrl;
 this.windowName=eWebEditProDefaults.installPopupWindowName;this.windowFeatures=eWebEditProDefaults.installPopupWindowFeatures;
 this.query=eWebEditProDefaults.installPopupQuery;this.open=installPopup_open;}
function installPopup_open(){if (this.url){var strUrl=this.url;if (this.query){strUrl +="?" + this.query;
 } window.open(strUrl,this.windowName,this.windowFeatures);} }
function commonPopup(){this.objWindow=null;this.isOpen=commonPopup_isOpen;this.isClosedWindow=commonPopup_isClosedWindow;
 this.close=commonPopup_close;this.focus=commonPopup_focus;this.getWindow=commonPopup_getWindow;
}
function commonPopup_isOpen(){return (this.objWindow && !this.objWindow.closed);}
function commonPopup_isClosedWindow(){return (this.objWindow && this.objWindow.closed);
}
function commonPopup_close(){if (this.isOpen()){this.objWindow.close();} this.objWindow=null;
}
function commonPopup_focus(){if (this.isOpen()){this.objWindow.focus();}}
function commonPopup_getWindow(){if (this.isOpen()){return this.objWindow;} else{
 return null;}}
var EWEP_ONUNLOAD_PROMPT="prompt";var EWEP_ONUNLOAD_SAVE="save";var EWEP_ONUNLOAD_NOSAVE="nosave";
var g_eWebEditProFactory_singleton=false;function eWebEditProFactory(){if (g_eWebEditProFactory_singleton){
 alert("Only one instance of eWebEditProFactory may be created.");return;} g_eWebEditProFactory_singleton=true;
 this.delayOnLoadRetry=100;this.timeLimitOnLoadRetry=3000;this.parameters=new eWebEditProParameters;
 if (typeof cVERSION !="undefined"){this.version=cVERSION;} this.addInstanceType=eWebEditProFactory_addInstanceType;
 this.refreshStatus=eWebEditProFactory_refreshStatus;this.valid=eWebEditProFactory_valid;
 this.validButton=eWebEditProFactory_validButton;this.autoInstallExpected=eWebEditProFactory_autoInstallExpected;
 this.instances=[];this.create=eWebEditProFactory_create;this.popups=[];this.createButton=eWebEditProFactory_createButton;
 this.edit=eWebEditProFactory_edit;this.findPopup=eWebEditProFactory_findPopup;this.createPopup=eWebEditProFactory_createPopup;
 this.checkPopupsInterval=100;this.checkPopups=eWebEditProFactory_checkPopups;this.defineParameterPropertyNames=eWebEditProFactory_defineParameterPropertyNames;
 this.hookOnSubmit=eWebEditProFactory_hookOnSubmit;this.load=eWebEditProFactory_load;
 this.save=eWebEditProFactory_save;this.querySave=eWebEditProFactory_querySave;this.clear=eWebEditProFactory_clear;
 this.isChanged=eWebEditProFactory_isChanged;this.nextFormField=eWebEditProFactory_nextFormField;
 this.searchFormElements=eWebEditProFactory_searchFormElements;this.parseQuery=eWebEditProUtil_parseQuery;
 this.openDialog=eWebEditProFactory_openDialog;this.autoInstallCookie=new eWebEditProCookie("autoinstall");
 this.autoInstallRefresh=eWebEditProFactory_autoInstallRefresh;this.instanceTypes=[];
 for (var i=0;i < g_ewepInstanceTypes.length;i++){this.addInstanceType(g_ewepInstanceTypes[i]);
 } this.selectedType=this.instanceTypes[this.instanceTypes.length-1].type;this.refreshStatus();
}
 eWebEditProFactory.prototype=new ClassModel;function eWebEditProFactory_addInstanceType(fnInstanceType){
 var objInstanceType=new fnInstanceType();if ("undefined"==typeof this.instanceTypes[objInstanceType.type]){
 this.instanceTypes[this.instanceTypes.length]=objInstanceType;} this.instanceTypes[objInstanceType.type]=objInstanceType;
 if (this.parameters){objInstanceType.refreshStatus(this.parameters);}}
function eWebEditProFactory_refreshStatus(parameters){if (typeof parameters !="object" || (null==parameters)){
 parameters=this.parameters;} extendObject(this,PlatformInfo);if (parameters["preferredType"]){
 if (this.instanceTypes[parameters["preferredType"]]){eWebEditPro.selectedType=parameters["preferredType"];
 } } for (var i=0;i < this.instanceTypes.length;i++){this.instanceTypes[i].refreshStatus(parameters);
 } var objInstanceType=this.instanceTypes[this.selectedType];if (objInstanceType){
 this.isSupported=objInstanceType.isSupported;this.isAutoInstallSupported=objInstanceType.isAutoInstallSupported;
 this.isInstalled=objInstanceType.isInstalled;this.upgradeNeeded=objInstanceType.upgradeNeeded;
 this.versionInstalled=objInstanceType.versionInstalled;} else{this.isSupported=false;
 this.isAutoInstallSupported=false;this.isInstalled=false;this.upgradeNeeded=false;
 } this.status=(this.isSupported ? (this.isInstalled ? EWEP_STATUS_INSTALLED : EWEP_STATUS_NOTINSTALLED) : EWEP_STATUS_NOTSUPPORTED);
 return this.status;}
function eWebEditProFactory_valid(){var bValid=(this.isSupported && (this.isInstalled || this.isAutoInstallSupported));
 var objInstanceType=this.instanceTypes[this.selectedType];if (bValid && objInstanceType){
 return objInstanceType.valid();} else{return bValid;}}
function eWebEditProFactory_validButton(){return (this.isSupported);}
function eWebEditProFactory_autoInstallExpected(){return (this.valid() && this.isAutoInstallSupported && (!this.isInstalled || this.upgradeNeeded));
}
function eWebEditProFactory_autoInstallRefresh(){if (this.autoInstallCookie){this.autoInstallCookie.removeCookie();
 location.reload();location.href="#";}}
function eWebEditProFactory_create(name,width,height,parameters){if (typeof parameters !="object" || (null==parameters)){
 parameters=this.parameters;} this.defineParameterPropertyNames(parameters);if (this.autoInstallExpected()){
 this.refreshStatus(parameters);} this.initEvent("oncreate");this.event.name=name;
 this.event.width=width;this.event.height=height;this.event.parameters=parameters;
 if (this.raiseEvent("oncreate")==false){return null;} name=this.event.name;width=this.event.width;
 height=this.event.height;parameters=this.event.parameters;if (typeof parameters !="object" || (null==parameters)){
 parameters=this.parameters;} var objInstance=null;parameters.isPopup=false;parameters.linkToName="";
 parameters.linkToWindow="";var strPopupElementWindow="top.opener";if (top.opener && top.location.search){
 var args=eWebEditProUtil.queryArgs;if (args["element"]){parameters.isPopup=true;
 if (args["elementWindow"]){strPopupElementWindow +="." + args["elementWindow"];}
 if (args["parameters"]){var objElem=findElement(args["parameters"],strPopupElementWindow);
 if (objElem && objElem["value"]){var sParameters=unescape(objElem.value);if (sParameters.length > 0){
 extendObject(parameters,new Function(sParameters));this.refreshStatus(parameters);
 } } } parameters.linkToName=args["element"];parameters.linkToWindow=strPopupElementWindow;
 } args=null;} if (!this.isNetscape60){parameters.editorDocumentLayer=findElementDocumentLayer(name,parameters.editorWindow);
 } var bShowAutoInstallMessage=false;if (this.autoInstallCookie){this.autoInstallCookie.evalDocument=parameters.getEditorDocument();
 this.autoInstallCookie.evalWindow=parameters.editorWindow;} if (this.autoInstallExpected() && parameters.installPopup && parameters.installPopup.url){
 this.isAutoInstallSupported=false;if (this.upgradeNeeded){this.isInstalled=false;
 } bShowAutoInstallMessage=true;var bShowPopup=true;if (this.autoInstallCookie){if (this.version==this.autoInstallCookie.getCookie()){
 bShowPopup=false;} else{this.autoInstallCookie.setCookie(this.version);bShowPopup=true;
 } } if (bShowPopup){parameters.installPopup.open();} } else if (this.isAutoInstallSupported && parameters.installPopup){
 if (this.autoInstallCookie){this.autoInstallCookie.removeCookie();} } var objInstanceType=null;
 var iPreferredType=-1;var maxPreference=1;for (var i=0;i < this.instanceTypes.length;
 i++){objInstanceType=this.instanceTypes[i];if (objInstanceType){if (objInstanceType.type==this.selectedType){
 objInstanceType.isSupported=objInstanceType.isSupported && this.isSupported;objInstanceType.isAutoInstallSupported=objInstanceType.isAutoInstallSupported && this.isAutoInstallSupported;
 objInstanceType.isInstalled=objInstanceType.isInstalled && this.isInstalled;objInstanceType.upgradeNeeded=objInstanceType.upgradeNeeded && this.upgradeNeeded;
 } if (objInstanceType.valid()){var preference=objInstanceType.currentPreference(width,height,parameters);
 if (objInstanceType.type==parameters["preferredType"]){maxPreference=1000;iPreferredType=i;
 break;} else if (preference >=maxPreference){maxPreference=preference;iPreferredType=i;
 } } } } if (iPreferredType >=0){objInstanceType=this.instanceTypes[iPreferredType];
 objInstance=objInstanceType.create(name,width,height,parameters);if (1==maxPreference){
 objInstanceType=this.instanceTypes["activex"];if (objInstanceType){if (objInstanceType.isSupported && !objInstanceType.isInstalled){
 if (eWebEditProMessages.clientInstallMessage){conditional_write(eWebEditProMessages.clientInstallMessage,objInstance,parameters);
 } } } if (bShowAutoInstallMessage){if (eWebEditProMessages.clientAutoInstallMessage){
 conditional_write(eWebEditProMessages.clientAutoInstallMessage,objInstance,parameters);
 } } } } if (!objInstance){return null;} if (this.instances.length==0){this.instances=new Array();
 } this.instances[this.instances.length]=objInstance;this.instances[name]=objInstance;
 if (!window["eWebEditProUnloadHandled"]){window.eWebEditProUnloadHandled=true;if (this.isIE){
 window.onbeforeunload=this.subclassEvent(window.onbeforeunload,'return eWebEditPro.querySave()');
 if (typeof this.actionOnUnload=="undefined"){this.actionOnUnload=EWEP_ONUNLOAD_SAVE;
 } } else{} } if (typeof this.actionOnUnload=="undefined"){this.actionOnUnload=EWEP_ONUNLOAD_NOSAVE;
 } if (!this.isNetscape60){var myForm=findElementForm(name,objInstance.evalWindow);
 if (myForm && !myForm["eWebEditProSubmitHandled"]){myForm.eWebEditProSubmitHandled=true;
 if (!parameters.asyncEnabled){myForm.onsubmit=this.subclassEvent(myForm.onsubmit,'return eWebEditPro.save()');
 } else{this.hookOnSubmit(myForm);} } if (!myForm && !parameters.isPopup){if (eWebEditProMessages.elementNotFoundMessage){
 conditional_write(eWebEditProMessages.elementNotFoundMessage + name,null,parameters);
 } } if (myForm && typeof myForm.method !="object"){var strMethod=myForm.method +"";
 if ("1"==strMethod){strMethod="post";} else if ("0"==strMethod){strMethod="get";
 } strMethod=strMethod.toLowerCase();if (strMethod !="post"){conditional_write(eWebEditProMessages.invalidFormMethodMessage,null,parameters);
 } } } if (!window["eWebEditProLoadHandled"]){window.eWebEditProLoadHandled=true;
 window.onload=this.subclassEvent(window.onload,'eWebEditPro.load()');} if (objInstance){
 objInstance.totalDelayOnLoadRetry=0;} return objInstance;}
function eWebEditProFactory_createButton(buttonName,elementName,parameters){var oPopup=null;
 this.initEvent("oncreatebutton");this.event.buttonName=buttonName;this.event.elementName=elementName;
 this.event.parameters=parameters;if (this.raiseEvent("oncreatebutton")==false){return;
 } buttonName=this.event.buttonName;elementName=this.event.elementName;parameters=this.event.parameters;
 if (this.validButton()){if (typeof parameters !="object" || (null==parameters)){
 parameters=this.parameters;} if (!this.isNetscape60){parameters.editorDocumentLayer=findElementDocumentLayer(elementName,parameters.editorWindow);
 } this.defineParameterPropertyNames(parameters);var aryNames=findFormAndElementName(elementName);
 var name=aryNames[0] + aryNames[1];var i=this.popups.length;oPopup=this.createPopup(parameters.popup,elementName,parameters.editorWindow,"ewepParameters" + i);
 oPopup.html="";if (!aryNames[0]){if (eWebEditProMessages.elementNotFoundMessage){
 conditional_write(eWebEditProMessages.elementNotFoundMessage + elementName,null,parameters);
 } } conditional_write('<input type="hidden" name="' + oPopup.parametersName +'" value="' + escape(parameters.reconstructor()) +'">',oPopup,parameters);
 if (buttonName && parameters.buttonTag && parameters.buttonTag.valid()){var sButtonHtml=parameters.buttonTag.createHTML(buttonName,elementName);
 conditional_write(sButtonHtml,oPopup,parameters);} } return oPopup;}
function eWebEditProFactory_edit(elementName){this.initEvent("onbeforeedit");this.event.elementName=elementName;
 if (this.raiseEvent("onbeforeedit")==false){return;} elementName=this.event.elementName;
 var oPopup=this.popups[elementName];if (!oPopup){oPopup=this.createPopup(this.parameters.popup,elementName,this.parameters.editorWindow);
 } oPopup.changed=false;oPopup.open();setTimeout("eWebEditPro.checkPopups()",eWebEditPro.checkPopupsInterval);
}
function eWebEditProFactory_findPopup(elementName){var oPopup=null;for (var i=0;i < this.popups.length;
 i++){if (this.popups[i].elementName==elementName){oPopup=this.popups[i];break;} }
 return oPopup;}
function eWebEditProFactory_createPopup(oPopupPrototype,elementName,elementWindow,parametersName){
 var oPopup=null;if (oPopupPrototype){oPopup=cloneObject(oPopupPrototype);} else{
 oPopup=new eWebEditProPopup;} if (elementName){oPopup.elementName=elementName;} if (elementWindow){
 oPopup.elementWindow=elementWindow;} if (parametersName){oPopup.parametersName=parametersName;
 } if (this.popups.length==0){this.popups=new Array();} this.popups[this.popups.length]=oPopup;
 if (elementName){this.popups[elementName]=oPopup;} return oPopup;}
function eWebEditProFactory_checkPopups(){var objPopup=null;var numOpenPopups=0;for (var i=0;
 i < this.popups.length;i++){objPopup=this.popups[i];if (objPopup.isOpen()){numOpenPopups++;
 } else if (objPopup.isClosedWindow()){this.initEvent("onedit");this.event.elementName=this.popups[i].elementName;
 this.event.popup=this.popups[i];this.raiseEvent("onedit");objPopup.close();} } objPopup=null;
 if (numOpenPopups > 0){setTimeout("eWebEditPro.checkPopups()",eWebEditPro.checkPopupsInterval);
 }}
function eWebEditProFactory_defineParameterPropertyNames(parameters){parameters.definePropertyName("preferredType");
 for (var iType=0;iType < this.instanceTypes.length;iType++){var aryParameterPropertyNames=this.instanceTypes[iType].parameterPropertyNames;
 for (var iName=0;iName < aryParameterPropertyNames.length;iName++){parameters.definePropertyName(aryParameterPropertyNames[iName]);
 } }}
function eWebEditProFactory_openDialog(editorName,fileName,query,windowName,windowFeatures){
 var strUrl=fileName +"";if (strUrl.indexOf("/") < 0 && strUrl.indexOf("\\") < 0){
 strUrl=this.parameters.path + strUrl;} if (strUrl.indexOf("?") < 0){strUrl +="?";
 } else{strUrl +="&";} strUrl +="editorName=" + escape(editorName) +"&editorname=" + escape(editorName);
 if (query){strUrl +="&" + query;} return window.open(strUrl,windowName,windowFeatures);
}
function eWebEditProFactory_isChanged(){for (var i=0;i < this.instances.length;i++){
 if (this.instances[i].isChanged()){return true;} } return false;}
function eWebEditProFactory_hookOnSubmit(objForm){if (!objForm || typeof objForm !="object"){
 return;} var bHook=false;if (objForm.onsubmit){bHook=true;var objHook=new ClassModel();
 objHook.defineProperty("fnOldOnSubmit",objForm.onsubmit);} var sCode="";if (bHook){
 sCode +="extendObject(this, new Function(unescape('" + escape(objHook.reconstructor()) +"')));\n";
 } sCode +="var bReturned = false;\n";sCode +="var bResult = false;\n";sCode +="eWebEditPro.save(this, function(bSaved) {\n";
 sCode +="bResult = bSaved;\n";if (bHook){sCode +="if (bResult || 'undefined' == typeof bResult) bResult = this.fnOldOnSubmit();\n";
 } sCode +="if (bResult && bReturned) {\n";sCode +='  if (("function" == typeof this.submit) || (("object" == typeof this.submit) && ("undefined" == typeof this.submit.value))) { this.submit() } \n';
 sCode +='  else {\n';sCode +='    var sMsg = "Asynchronous eWebEditPro methods require the form.submit method.\\n";\n';
 sCode +='	  sMsg += "A form element named \\\'submit\\\' already exists that replaced the form.submit method.\\n";\n';
 sCode +='	  sMsg += "\\nPlease change the name of the \\\'submit\\\' element to another name.\\n";\n';
 sCode +='	  if (this.submit.outerHTML) {\n';sCode +='	    sMsg += "The \\\'submit\\\' element is defined as: " + this.submit.outerHTML + "\\n";\n';
 sCode +='	  }\n';sCode +='	  sMsg += "\\nThe form cannot be submitted asynchronously until this is fixed.\\n";\n';
 sCode +='	  alert(sMsg);\n';sCode +='  }\n';sCode +="}\n";sCode +="return bResult; });\n";
 sCode +="bReturned = true;\n";sCode +="return bResult;\n";var fnNewOnSubmit=new Function(sCode);
 objForm.onsubmit=fnNewOnSubmit;return fnNewOnSubmit;}
function eWebEditProFactory_load(instanceId,bLoad){if (3 <=arguments.length){alert("Incorrect number of arguments for eWebEditPro.load method.");
 return;} var bComplete=false;var idType=typeof instanceId;if ("undefined"==idType){
 setTimeout('eWebEditPro.load(true)',1);return;} else if ("boolean"==idType){this.initEvent("onbeforeload");
 if (this.raiseEvent("onbeforeload")==false){return;} if (this.instances.length > 0){
 this.status=EWEP_STATUS_LOADING;for (var i=0;i < this.instances.length;i++){var objInstance=this.instances[i];
 objInstance.totalDelayOnLoadRetry=0;if (instanceId || objInstance.isReady()){this.load(i);
 } else{objInstance.loadWhenReady=true;} } } else{bComplete=true;} } else{var objInstance=null;
 if ("number"==idType){var i=instanceId;if (0 <=i && i < this.instances.length){objInstance=this.instances[i];
 } } else if ("string"==idType){objInstance=this.instances[instanceId];} else if ("object"==idType){
 objInstance=instanceId;} if (objInstance){if (this.isNetscape60){var myForm=findElementForm(objInstance.name,objInstance.evalWindow);
 if (myForm && !myForm["eWebEditProSubmitHandled"]){myForm.eWebEditProSubmitHandled=true;
 if (!objInstance.asyncActive){myForm.onsubmit=this.subclassEvent(myForm.onsubmit,'return eWebEditPro.save()');
 } else{this.hookOnSubmit(myForm);} } } objInstance.factoryTimedout=false;objInstance.factoryLoaded=false;
 if (eWebEditProMessages.loading){window.status=eWebEditProMessages.loading +" " + objInstance.name +"...";
 } if (objInstance.status !=EWEP_STATUS_LOADING && (false !=bLoad)){objInstance.load();
 } if (EWEP_STATUS_LOADED==objInstance.status){this[objInstance.name]=objInstance.editor;
 objInstance.factoryLoaded=true;objInstance.loadWhenReady=false;} else if (EWEP_STATUS_LOADING==objInstance.status){
 setTimeout('eWebEditPro.load("' + objInstance.name +'", false)',this.delayOnLoadRetry);
 } else if (objInstance.loadWhenReady){objInstance.factoryTimedout=true;objInstance.loadWhenReady=false;
 } else{if (this.timeLimitOnLoadRetry==-1 || (objInstance.totalDelayOnLoadRetry < this.timeLimitOnLoadRetry)){
 if (this.timeLimitOnLoadRetry !=-1){objInstance.totalDelayOnLoadRetry +=this.delayOnLoadRetry;
 } setTimeout('eWebEditPro.load("' + objInstance.name +'")',this.delayOnLoadRetry);
 } else{if ((this.isIE && this.browserVersion < 5.0) || (this.isNetscape && this.browserVersion < 5.0) || ("java"==objInstance.type)){
 objInstance.loadWhenReady=true;} else{objInstance.factoryTimedout=true;} } } } else{
 this.initEvent("onerror");this.event.source="load";this.event.name=instanceId +"";
 this.event.instance=null;this.raiseEvent("onerror");} var objInstance=null;var numLoaded=0;
 var iInstanceTimedout=-1;var iInstanceToLoad=-1;for (var i=0;i < this.instances.length;
 i++){objInstance=this.instances[i];if (objInstance.factoryLoaded){numLoaded++;} else if (!objInstance.factoryTimedout){
 if (-1==iInstanceToLoad){iInstanceToLoad=i;} } else{if (-1==iInstanceTimedout){iInstanceTimedout=i;
 } } } objInstance=null;var strStatus=window.status;if (0 <=iInstanceToLoad && iInstanceToLoad < this.instances.length){
 objInstance=this.instances[iInstanceToLoad];if (eWebEditProMessages.waitingToLoad){
 strStatus=eWebEditProMessages.waitingToLoad +" " + objInstance.name +"...";} bComplete=false;
 objInstance=null;} else if (0 <=iInstanceTimedout && iInstanceTimedout < this.instances.length){
 objInstance=this.instances[iInstanceTimedout];if (eWebEditProMessages.errorLoading){
 strStatus=eWebEditProMessages.errorLoading +" " + objInstance.name;} this.status=objInstance.status;
 this.initEvent("onerror");this.event.source="load";this.event.name=objInstance.name;
 this.event.instance=objInstance;if (this.raiseEvent("onerror") !=false){if (0==numLoaded){
 if (this.isActiveXSupported && eWebEditProMessages.installPrompt && eWebEditProDefaults.clientInstall){
 if (confirm(eWebEditProMessages.installPrompt)){window.open(eWebEditProDefaults.clientInstall,"","");
 } } } } bComplete=true;objInstance=null;} else{if (eWebEditProMessages.doneLoading){
 strStatus=eWebEditProMessages.doneLoading;} this.status=EWEP_STATUS_LOADED;bComplete=true;
 } if (strStatus !=window.status){window.status=strStatus;} } if (bComplete){this.initEvent("onload");
 setTimeout('eWebEditPro.raiseEvent("onload")',1);}}
function eWebEditProFactory_save(objNotify,fnNotify){if (1==arguments.length || 3 <=arguments.length){
 alert("Incorrect number of arguments for eWebEditPro.save method.");return false;
 } var bReturnValue=true;this.initEvent("onbeforesave");if (this.raiseEvent("onbeforesave")==false){
 return false;} if (this.instances.length > 0){this.status=EWEP_STATUS_SAVING;} this.asyncLoop=function (i){
 if (i < this.instances.length){var objInstance=this.instances[i];if (objInstance.isChanged() && (!objInstance.asyncActive || fnNotify)){
 if (eWebEditProMessages.saving){window.status=eWebEditProMessages.saving +" " + objInstance.name +"...";
 } objInstance.save(objInstance.linkedElement,this,function (bSaveSuccessful){if (!bSaveSuccessful){
 if (objInstance.factoryLoaded){this.status=objInstance.status;this.initEvent("onerror");
 this.event.source="save";this.event.name=objInstance.name;this.event.instance=objInstance;
 this.raiseEvent("onerror");bReturnValue=false;} else{} } i++;this.asyncLoop(i);return bReturnValue;
 });} else{i++;this.asyncLoop(i);} } else{if (this.instances.length > 0){if (eWebEditProMessages.doneSaving){
 window.status=eWebEditProMessages.doneSaving;} if (bReturnValue){this.status=EWEP_STATUS_SAVED;
 } } this.initEvent("onsave");var retVal=this.raiseEvent("onsave");if ("boolean"==typeof retVal){
 bReturnValue=retVal;} bReturnValue=notifyObject(objNotify,fnNotify,bReturnValue);
 return bReturnValue;} };this.asyncLoop(0);return bReturnValue;}
function eWebEditProFactory_querySave(){if (this.instances.length > 0){var bSkipSave=false;
 if (!this.isChanged()){bSkipSave=true;} else if (EWEP_ONUNLOAD_NOSAVE==this.actionOnUnload){
 bSkipSave=true;} else if (this.actionOnUnload !=EWEP_ONUNLOAD_SAVE){var objElem=document.elementFromPoint(event.clientX,event.clientY);
 if (objElem){var sTag=objElem.tagName +"";sTag=sTag.toUpperCase();if ("INPUT"==sTag){
 var sType=objElem.type +"";sType=sType.toLowerCase();if ("submit"==sType){bSkipSave=true;
 } } else if ("A"==sTag){var sProtocol=objElem.protocol +"";var sTarget=objElem.target +"";
 sProtocol=sProtocol.toLowerCase();sTarget=sTarget.toLowerCase();var isTargetSelf=(""==sTarget ||"_self"==sTarget ||"_parent"==sTarget ||"_top"==sTarget);
 if (!isTargetSelf || ("javascript:"==sProtocol)){bSkipSave=true;} } } } if (!bSkipSave){
 var bSaved=false;if (this.actionOnUnload !=EWEP_ONUNLOAD_SAVE && eWebEditProMessages.querySave){
 if (confirm(eWebEditProMessages.querySave)){bSaved=this.save();} } else{bSaved=this.save();
 } if (!bSaved && eWebEditProMessages.confirmAway){return eWebEditProMessages.confirmAway;
 } } }}
function eWebEditProFactory_clear(){if (this.instanceTypes.length > 0){for (var i=this.instanceTypes.length - 1;
 i >=0;i--){this.instanceTypes[i].clear();} } if (this.instances.length > 0){for (var i=this.instances.length - 1;
 i >=0;i--){var name=this.instances[i].name;this[name]=null;this.instances[i].clear();
 this.instances[name]=null;this.instances[i]=null;this.instances.length--;} this.instances=[];
 } if (this.popups.length > 0){for (var i=this.popups.length - 1;i >=0;i--){var elementName=this.popups[i].elementName;
 this.popups[i].close();this.popups[i]=null;if (elementName){this.popups[elementName]=null;
 } this.popups.length--;} this.popups=new Array();} }
function eWebEditProFactory_nextFormField(objInstance){var objField=this.searchFormElements(objInstance,false);
 if (!objField){objField=this.searchFormElements(objInstance,true);} return objField;
}
function eWebEditProFactory_searchFormElements(objInstance,bSearchForNextField){for (var iForm=0;
 iForm < document.forms.length;iForm++){for (var iElem=0;iElem < document.forms[iForm].elements.length;
 iElem++){var objElem=document.forms[iForm].elements[iElem];if (objInstance.isInstance(objElem)){
 bSearchForNextField=true;} else if (bSearchForNextField){if (canElementReceiveFocus(objElem)){
 return objElem;} else{for (var i=0;i < this.instances[i].length;i++){if (this.instances[i].isInstance(objElem)){
 return this.instances[i];} } } } } } return null;}
function canElementReceiveFocus(objElem){if (!objElem) return false;var strType=objElem.type +"";
 if ("hidden"==strType) return false;var strDisabled=objElem.disabled +"";if ("true"==strDisabled) return false;
 var strIsTextEdit=objElem.isTextEdit +"";if ("false"==strIsTextEdit) return false;
 var strFocusMethod=typeof objElem.focus;if ("function" !=strFocusMethod &&"object" !=strFocusMethod) return false;
 return true;}
var eWebEditPro=new eWebEditProFactory;var eWebWP=eWebEditPro;eWebEditProPath=eWebWPPath;
