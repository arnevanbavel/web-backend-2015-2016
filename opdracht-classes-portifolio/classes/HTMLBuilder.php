<?php

	class HTMLbuilder {

		protected $header;
		protected $body;
		protected $footer;
        public $cssLinks;
	
		public function __construct($header, $body, $footer){
			$this->header	=	$header;
			$this->body		=	$body;
			$this->footer	=	$footer;

			$this->buildHeader();
			$this->buildBody();
			$this->buildFooter();
		}
		
		public function buildHeader(){ 
			$files	= $this->findFiles('/css/', 'css'); 
			$cssLinks =	$this->createCssLink($files);
		      
			include'html/'. $this->header;
		}	
		
		public function buildBody(){
			include'html/'. $this->body;
		}	
		
		public function buildFooter(){
			$files = $this->findFiles('/js/', 'js');
			$jsScripts = $this->createJsScripts($files);
			
			include'html/'. $this->footer;
		}
		
		
		public function findFiles($dir, $file)
		{
			return glob($dir . '/*.' . $file);	  //glob geeft terug css.*.css waar sterreteje alles kan zijn
		}
		
		public function createCssLink($files)
		{
			$dumpArray	=	array();                //array aanmaken
			foreach ($files as $file)                //door parameter lopen,array met alle files
			{
				$fileInfo	=	pathinfo($file);    //pathinfo geeft array terug met [dirname][basename][extension]
				$fileName	=	$fileInfo['basename'];  //basename = global.css
				
				$dumpArray[] = '<link rel="stylesheet" type="text/css" href="css/' . $fileName . '">'; // alle links aanmaken en in array steken
			}
			return implode('', $dumpArray);  //zet array om in string
		}
		
		public function createJsScripts($files)
		{
			$dumpArray	=	array();
			
			foreach ($files as $file)
			{
				$fileInfo	=	pathinfo($file);
				$fileName	=	$fileInfo['basename'];
				
				$dumpArray[] = '<script src="js/' . $fileName . '"></script>';
			}
			return implode('', $dumpArray);
		}
	}


?>