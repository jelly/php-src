--TEST--
openssl_pkcs7_read() tests
--SKIPIF--
<?php if (!extension_loaded("openssl")) print "skip"; ?>
--FILE--
<?php
$pkcsfile = tempnam(sys_get_temp_dir(), "ssl");
if ($pkcsfile === false) {
	die("failed to get a temporary filename!");
}

$pemcert = dirname(__FILE__) . "/cert.crt";
$infile = dirname(__FILE__) . "/cert.p7b";
$result = [];

var_dump(openssl_pkcs7_read());
var_dump(openssl_pkcs7_read($pemcert));
var_dump(openssl_pkcs7_read($pemcert, $result));
var_dump(openssl_pkcs7_read($pkcsfile, $result));
var_dump(openssl_pkcs7_read($infile, $result));
var_dump(empty($result));

if (file_exists($pkcsfile)) {
	echo "true\n";
	unlink($pkcsfile);
}
?>
--EXPECTF--
Warning: openssl_pkcs7_read() expects exactly 2 parameters, 0 given in %s on line %d
bool(false)

Warning: openssl_pkcs7_read() expects exactly 2 parameters, 1 given in %s on line %d
bool(false)
bool(false)
bool(false)
bool(true)
bool(false)
true
