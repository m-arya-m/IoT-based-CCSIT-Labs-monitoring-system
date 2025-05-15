<?php
class Rectangle 

{
    
    private $length=0;
    private $width=0;

    public function getlength()  { 
        return $this->length;
    }
  
    public function setlength($length) { 
        $this->length = $length; 
    }

    public function getwidth() { 
        return $this->width; 
    }
  
    public function setwidth($width) {
         $this->width = $width; 
        }

    public function getPerimeter(){
        return (2 * ($this->length + $this->width));
    }

    public function getArea(){
        return ( $this->length * $this->width);
    }
}
?>
