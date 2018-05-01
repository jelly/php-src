--TEST--
openssl_pkcs7_mem_verify() tests
--SKIPIF--
<?php if (!extension_loaded("openssl")) print "skip"; ?>
--FILE--
<?php
$outfile = tempnam(sys_get_temp_dir(), "ssl");
if ($outfile === false) {
	die("failed to get a temporary filename!");
}

$infile = dirname(__FILE__) . "/cert.crt";
$eml = file_get_contents(dirname(__FILE__) . "/signed.eml");
$wrong = "wrong";
$empty = "";
$cainfo = array();
$cert = "";
$content = "";

var_dump(openssl_pkcs7_mem_verify($wrong, 0));
var_dump(openssl_pkcs7_mem_verify($empty, 0));
var_dump(openssl_pkcs7_mem_verify($eml, 0));
var_dump(openssl_pkcs7_mem_verify($eml, 0, $empty));
var_dump(openssl_pkcs7_mem_verify($eml, PKCS7_NOVERIFY, $cert));
file_put_contents($outfile, $cert);
var_dump(openssl_pkcs7_mem_verify($eml, PKCS7_NOVERIFY, $cert, $cainfo, $outfile, $content));
var_dump($content);
?>
--CLEAN--
--EXPECTF--
int(-1)
int(-1)
bool(false)
bool(false)
bool(true)
