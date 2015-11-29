<?php
/**
 *	This class is for pagination
 ************************************************************************
 *	@Author Xiaoming Yang
 *	@Date	2015-11-28 20:54
 ************************************************************************
 *	update time			editor				updated information
 */

class Pagination {
    private $total;             //the total number of data
    private $rowNum;           //how many rows in one page
    private $totalPage;         //number of total page
    private $currentPage;       //current page
    private $uri;               //the requested url
    private $listNum;           //how many pagination list, if it is set to 5, the page will show 1 2 3 4 5

    /**
     * @param	string	$total	the total number of data
     * @param	string	$action which action handle the request
     * @param	string	$method which method to handle the request
     */
    public function __construct(){
        //get configuration about list number
        $config = require("config.php");
        $this->rowNum = isset($config['page']['rowNum']) ? $config['page']['rowNum'] : 20;
        $this->listNum = isset($config['page']['listNum']) ? $config['page']['listNum'] : 11;

        $this->uri = ROOT_FILE.'/'.$_REQUEST['rController'].'/'.$_REQUEST['rMethod'];
    }

    public function __get($param){
        return $this->$param;
    }
    public function __set($name,$value){
        $this->$name = $value;
    }

    /**
     * Set total rows and other fields
     * @param	string	$total	the total number of data
     */
    public function setValues($total){

        $this->total = $total;
        $this->totalPage = ceil($total/$this->rowNum);

        if($this->total > 0){
            if(!empty($_REQUEST["page"])){
                $this->currentPage = $_REQUEST["page"];
            }else{
                $this->currentPage = 1;
            }
        }else{
            $this->currentPage = 0;
        }
    }



    /**
     * output the pagination bar
     * @param	string	$total	the total number of data
     * @param	string	$action which action handle the request
     * @param	string	$method which method to handle the request
     */
    public function outputPage(){
        $str = "";
        if($this->total > 0){
            //output the first and prev
            $str = "<li><a href='$this->uri?page=1'>"."First</a></li>";
            if($this->currentPage > 1){
                $str .= "<li><a href='$this->uri?page=".($this->currentPage-1)."'>"."Prev</a></li>";
            }else if($this->currentPage == 1){
                $str .= "<li><span>Prev</span></li>";
            }

            //output page list
            if($this->totalPage > $this->listNum){
                //output page list
                $lNum = floor($this->listNum/2);
                if($this->currentPage > $lNum){
                    $str .="<li><span><strong>...</strong></span></li>";
                }
                for($i=$lNum; $i>=1; $i--){
                    $tempPage = $this->currentPage - $i;
                    if($tempPage >= 1){
                        $str .= "<li><a href='$this->uri?page=".$tempPage."'>".$tempPage."</a></li>";
                    }
                }
                //output current page
                $str .= "<li class='active' ><a href='$this->uri?page=".$this->currentPage."'>".$this->currentPage."</a></li>";

                for($i=1; $i<=$lNum; $i++){
                    $tempPage = $this->currentPage + $i;
                    if($tempPage <= $this->totalPage){
                        $str .= "<li><a href='$this->uri?page=".$tempPage."'>".$tempPage."</a></li>";

                    }
                }

                //output ...
                if($this->currentPage < $this->totalPage-$lNum){
                    $str .="<li><span><strong>...</strong></span></li>";
                }
            }else if($this->totalPage >= 1 && $this->totalPage <= $this->listNum){
                for($i = 1; $i < $this->currentPage; $i++){
                    $str .= "<li><a href='$this->uri?page=".$i."'>".$i."</a></li>";
                }
                $str .= "<li class='active' ><a href='$this->uri?page=".$this->currentPage."'>".$this->currentPage."</a></li>";
                for($i = $this->currentPage+1; $i <= $this->totalPage; $i++){
                    $str .= "<li><a href='$this->uri?page=".$i."'>".$i."</a></li>";
                }

            }

            //output the next and last
            if($this->currentPage < $this->totalPage){
                $str .= "<li><a href='$this->uri?page=".($this->currentPage+1)."'>"."Next</a></li>";
            }else if($this->currentPage == $this->totalPage){
                $str .= "<li><span>Next</span></li>";
            }
            $str .= "<li><a href='$this->uri?page=".$this->totalPage."'>"."Last</a></li>";

            //output page information
            $str .= "<span class='pages'>Total:&nbsp; $this->total topics,$this->totalPage pages</span>";
        }

        return $str;
    }
}