<%@ WebService Language="VB" Class="WeddingService" %>

Imports System.Web;
Imports System.Web.Services;
Imports System.Web.Script.Services;
Imports System.Web.Script.Serialization;

<System Web.Script.Services.ScriptService()>_
<Webservice(Namespace:="http://tempuri.org/")>
Public Class WeddingService Inherits System.Web.Services.Webservice

<WebMethod()>
<ScriptMethod(ResponseFormat:= ResponeFormat.Json,UseHttpGet:=True)> _
Public Sub HelloWorld()

Dim context as New HttpContext(HttpContext.Current.Request,HttpContext.Current.Response)
context.Response.ContentType= "application/json;charset=utf-8"
context.Response.write("Here")
End Sub

End Class