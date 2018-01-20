<?php

class QuickGit {
  private $version;
  
  function __construct() {
    exec('git describe --always',$version_mini_hash);
    exec('git rev-list HEAD | wc -l',$version_number);
    exec('git log -1',$line);
    $this->version['short'] = "v1.".trim($version_number[0]).".".$version_mini_hash[0];
    $this->version['full'] = "v1.".trim($version_number[0]).".$version_mini_hash[0] (".str_replace('commit ','',$line[0]).")";
  }
  public function output() {
    return $this->version;
  }
  public function show() {
    echo $this->version;
  }
}