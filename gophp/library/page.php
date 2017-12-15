<?php

namespace gophp;

class page{

    public $firstRow; // 起始行数
    public $totalRows; // 总行数
    public $pageRows; // 列表每页显示行数
    public $totalPages; // 总页数
    public $nowPage = 1; // 当前页码
    public $pageParam; // 分页参数
    public $arguments = []; // 附加参数

    public function __construct($totalRows, $pageRows, $arguments = array())
    {

        $this->pageParam = config::get('http', 'page_param');

        $this->nowPage   = request::get($this->pageParam, 1);

        $this->totalRows = $totalRows; //设置总记录数
        $this->pageRows  = $pageRows;  //设置每页显示行数

        $this->firstRow  = $this->pageRows * ($this->nowPage - 1); // 设置起始行数

        // 计算总页数
        $this->totalPages = ceil($this->totalRows / $this->pageRows);

        if(!empty($this->totalPages) && $this->nowPage > $this->totalPages) {

            $this->nowPage = $this->totalPages;

        }

        return $this;

    }

    //生成页码链接
    public function url($pageNo)
    {

        $pageNo = $pageNo >= $this->totalPages ? $this->totalPages : intval($pageNo);

        if($pageNo > 0){

            return route::url('', [$this->pageParam => $pageNo], false, '');

        }else{

            return route::url('', '');

        }

    }

    //当前链接
    public function now()
    {

        return $this->url($this->nowPage);

    }
    
    //上一页链接
    public function prev()
    {

        $pageNo = ($this->nowPage - 1) > 0 ? ($this->nowPage - 1) : 1;

        return $this->url($pageNo);

    }
    
    //下一页链接
    public function next()
    {

        $pageNo = ($this->nowPage + 1) > $this->totalPages ? $this->totalPages : ($this->nowPage + 1);

        return $this->url($pageNo);

    }
    
    
    //第一页链接
    public function start()
    {

        return $this->url(1);

    }
    
    //最后一页链接
    public function end()
    {

        return $this->url($this->totalPages);

    }
    
    //总页数
    public function total()
    {

        return $this->totalPages;

    }

    // 数字导航数组
    public function numbers($length = 5)
    {

        $per = floor($length / 2);
        $min = $this->nowPage - $per;

        if ($length % 2) {

            $max = $this->nowPage + ceil($length / 2) - 1;

        } else {

            $max = $this->nowPage + $per - 1;

        }

        if ($max > $this->totalPages) {

            $min -= $max - $this->totalPages;

        }

        if ($min < 1) {

            $max += 1 - $min;

        }

        $max > $this->totalPages && $max = $this->totalPages;

        $min < 1 && $min = 1;

        $numbers = new \stdClass();

        foreach ( range($min, $max) as $k => $v) {

            $numbers->$k->num = $v;
            $numbers->$k->url = $this->url($v);

        }

        return $numbers;

    }

}
