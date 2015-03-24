<?php
function dd($argument) {
	die('<pre>' . print_r($argument, TRUE) . '</pre>');
}