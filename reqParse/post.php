<?php
/**
 * リクエストのパース
 */
require_once __DIR__ . '/../vendor/autoload.php';
$req = \Symfony\Component\HttpFoundation\Request::createFromGlobals();

// setTrustedProxies() すると、X_FORWARDED_FORが使われる。
// X_FORWARDED_FOR を信用するには、プロキシ元が確認できている場合のみ。
// つまり REMOTE_ADDR が trustedProxies の中のどれかだった場合じゃないとまずい。
$rawRemoteAddr = $req->getClientIp();
$trustedProxies = ['127.0.0.1']; // 信頼できるreverse proxy
// REMOTE_ADDR === 信頼できるproxy なら reveser-proxy下と判断。
if(in_array($req->getClientIp(), $trustedProxies)) {
    \Symfony\Component\HttpFoundation\Request::setTrustedProxies($trustedProxies);
}

?>
<html>
<head>
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/main.css">
<style>
table {
    width:100%;
}
table tr th {
    text-align: left;
    min-width:20%;
}
table tr th, table tr td {
    padding: 1px;
    border: 1px solid #000000;
}
</style>
</head>

<body>
<form method="post" action="<?=$req->getRequestUri()?>" enctype="multipart/form-data">
    <input name="name" type="text" value="<?=$req->get('name')?>"><br>

    <label><input name="rad1" type="radio" value="1" <?php if($req->get('rad1')==='1'):?>checked<?php endif?>>rad1</label>
    <label><input name="rad1" type="radio" value="2" <?php if($req->get('rad1')==='2'):?>checked<?php endif?>>rad2</label><br>

    <label><input name="chkB1[]" type="checkbox" value="1" <?php if(in_array('1', $req->get('chkB1',[]))):?>checked<?php endif?>>chkB1</label>
    <label><input name="chkB1[]" type="checkbox" value="2" <?php if(in_array('2', $req->get('chkB1',[]))):?>checked<?php endif?>>chkB2</label>
    <label><input name="chkB1[]" type="checkbox" value="3" <?php if(in_array('3', $req->get('chkB1',[]))):?>checked<?php endif?>>chkB3</label>
    <label><input name="chkB1[]" type="checkbox" value="4" <?php if(in_array('4', $req->get('chkB1',[]))):?>checked<?php endif?>>chkB4</label>
    <label><input name="chkB1[]" type="checkbox" value="5" <?php if(in_array('5', $req->get('chkB1',[]))):?>checked<?php endif?>>chkB5</label><br>

    <select name="sel1">
        <option value=""></option>
        <option value="apple" <?php if($req->get('sel1')==='apple'):?>selected<?php endif?>>りんご</option>
        <option value="banana" <?php if($req->get('sel1')==='banana'):?>selected<?php endif?>>バナナ</option>
        <option value="pear"  <?php if($req->get('sel1')==='pear'):?>selected<?php endif?>>梨</option>
    </select><br>

    <input name="file1" type="file"><br>

    <input name="send" type="submit"><br>
</form>


<div style="margin-top:20px">
リクエストパース系
<table>
    <tr><th>get('name', 'none')</th><td><?=var_dump($req->get('name', 'none'))?></td></tr>
    <tr><th>get('undef', 'none')</th><td><?=var_dump($req->get('undef', 'none'))?></td></tr>
    <tr><th>get('chkB1', []))</th><td><?=var_dump($req->get('chkB1', []))?></td></tr>
    <tr><th>files->get('file1')</th><td><?=var_dump($req->files->get('file1'))?></td></tr>
    <tr><th>getContent()</th><td><?=var_dump($req->getContent())?></td></tr>
    <tr><th>getContentType()</th><td><?=var_dump($req->getContentType())?></td></tr>
    <tr><th>normalizeQueryString($qs)</th><td><?=var_dump($req->getQueryString())?></td></tr>
</table>
</div>

<div style="margin-top:20px">
クライアント環境系
<table>
    <tr><th>getCharsets()</th><td><?=var_dump($req->getCharsets())?></td></tr>
    <tr><th>getLocale()</th><td><?=var_dump($req->getLocale())?></td></tr>
    <tr><th>getDefaultLocale()</th><td><?=var_dump($req->getDefaultLocale())?></td></tr>
    <tr><th>getPreferredLanguage()</th><td><?=var_dump($req->getPreferredLanguage())?></td></tr>
    <tr><th>getLanguages()</th><td><?=var_dump($req->getLanguages())?></td></tr>
    <tr><th>getEncodings()</th><td><?=var_dump($req->getEncodings())?></td></tr>
    <tr><th>getAcceptableContentTypes()</th><td><?=var_dump($req->getAcceptableContentTypes())?></td></tr>
    <tr><th>isNoCache()</th><td><?=var_dump($req->isNoCache())?></td></tr>
    <tr><th>getETags()</th><td><?=var_dump($req->getETags())?></td></tr>
    <tr><th>getRequestFormat()</th><td><?=var_dump($req->getRequestFormat())?></td></tr>
    <tr><th>getUser()</th><td><?=var_dump($req->getUser())?></td></tr>
    <tr><th>getUserInfo()</th><td><?=var_dump($req->getUserInfo())?></td></tr>
    <tr><th>getPassword()</th><td><?=var_dump($req->getPassword())?></td></tr>
</table>
</div>

<div style="margin-top:20px">
サーバ環境系
<table>
    <tr><th>getScheme()</th><td><?=var_dump($req->getScheme())?></td></tr>
    <tr><th>getHost()</th><td><?=var_dump($req->getHost())?></td></tr>
    <tr><th>getHttpHost()</th><td><?=var_dump($req->getHttpHost())?></td></tr>
    <tr><th>getPort()</th><td><?=var_dump($req->getPort())?></td></tr>
    <tr><th>getSchemeAndHttpHost()</th><td><?=var_dump($req->getSchemeAndHttpHost())?></td></tr>

    <tr><th>getBaseUrl()</th><td><?=var_dump($req->getBaseUrl())?></td></tr>
    <tr><th>getBasePath()</th><td><?=var_dump($req->getBasePath())?></td></tr>
    <tr><th>getPathInfo()</th><td><?=var_dump($req->getPathInfo())?></td></tr>
    <tr><th>getQueryString()</th><td><?=var_dump($req->getQueryString())?></td></tr>
    <tr><th>getUri()</th><td><?=var_dump($req->getUri())?></td></tr>
    <tr><th>getRequestUri()</th><td><?=var_dump($req->getRequestUri())?></td></tr>
    <tr><th>getScriptName()</th><td><?=var_dump($req->getScriptName())?></td></tr>
    <tr><th>getMethod()</th><td><?=var_dump($req->getMethod())?></td></tr>
    <tr><th>getRealMethod()</th><td><?=var_dump($req->getRealMethod())?></td></tr>
    <tr><th>isMethod('get')</th><td><?=var_dump($req->isMethod('get'))?></td></tr>
    <tr><th>isMethod('post')</th><td><?=var_dump($req->isMethod('post'))?></td></tr>
    <tr><th>isMethodSafe()</th><td><?=var_dump($req->isMethodSafe())?></td></tr>
    <tr><th>getClientIp()</th><td><?=var_dump($req->getClientIp())?></td></tr>
    <tr><th>getClientIps()</th><td><?=var_dump($req->getClientIps())?></td></tr>
    <tr><th>isSecure()</th><td><?=var_dump($req->isSecure())?></td></tr>
    <tr><th>isXmlHttpRequest()</th><td><?=var_dump($req->isXmlHttpRequest())?></td></tr>
</table>
</div>

<div style="margin-top:20px">
その他
<table>
    <tr><th>getHttpMethodParameterOverride()</th><td><?=var_dump($req->getHttpMethodParameterOverride())?></td></tr>
    <tr><th>getTrustedProxies()</th><td><?=var_dump($req->getTrustedProxies())?></td></tr>
    <tr><th>getTrustedHosts()</th><td><?=var_dump($req->getTrustedHosts())?></td></tr>
</table>
サーバ環境系
</div>

</body>
</html>