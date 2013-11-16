<?php
class pager {

    protected function __construct()
    {

    }

    // общее количество записей
    protected function get_total()
    {

    }

    // количество записей на страницу
    protected  function get_pnumber()
    {

    }

    // колличество ссылок слева и справа от текущей странице
    protected function get_page_link()
    {

    }

    // дополнительные параметры,
    // которые необходимо передать по ссылке
    protected function get_parameters()
    {

    }

    // ссылки на другие страницы
        public function __toString()
        {
            $return_page = "";

            // Через Get параметр page передает номер текущей страницы
            $page = intval($_GET['page']);
            if(empty($page)) $page = 1;

            // вычисляем число страниц в системе
            $number = (int)($this->get_total()/$this->get_pnumber());
            if((float)($this->get_total()/$this->get_pnumber()) - $number != 0)
            {
                $number++;
            }

            // Проверяем есть ли ссылки слева
            if($page - $this->get_page_link() > 1)
            {
                $return_page .= "<a href=$_SERVER[PHP_SELF]".
                "?page=1{$this->get_parameters()}>
                [1-{$this->get_pnumber()}]
                </a>&nbsp;&nbsp;...&nbsp;&nbsp;";

                // Есть
                for($i = $page - $this->get_page_link(); $i < $page; $i++)
                {
                    $return_page .= "&nbsp;<a href=$_SERVER[PHP_SELF]".
                    "?page=$i{$this->get_parameters()}>
                    [".(($i - 1)*$this->get_pnumber() + 1).
                    "-".$i*$this->get_pnumber()."]</a>&nbsp;";
                }
            }
            else
            {
                // Нет
                for($i = 1; $i < $page; $i++)
                {
                    $return_page .= "&nbsp;<a href=$_SERVER[PHP_SELF]".
                    "?page=$i{$this->get_parameters()}>
                    [".(($i - 1)*$this->get_pnumber() + 1).
                    "-".$i*$this->get_pnumber()."]
                    </a>&nbsp;";
                }
            }
            // Проверяем есть ли ссылки справа
            if($page + $this->get_page_link() < $number)
            {
                //  Есть
                for($i = $page; $i <= $page + $this->get_page_link(); $i++)
                {
                    if($page == $i)
                    {
                        $return_page .= "&nbsp;[".
                            (($i - 1) * $this->get_pnumber() + 1).
                            "-".$i*$this->get_pnumber()."]&nbsp;";
                    }
                    else
                    {
                        $return_page .= "&nbsp;<a href=$_SERVER[PHP_SELF]".
                        "?page=$i{$this->get_parameters()}>
                        [".(($i-1)*$this->get_pnumber()+1).
                        "-".$i*$this->get_pnumber()."]
                        </a>&nbsp;";
                    }
                }
                $return_page .= "&nbsp;...&nbsp;&nbsp;".
                "<a href=$_SERVER[PHP_SELF]".
                "?page=$number{$this->get_parameters()}>
                [".(($number - 1)*$this->get_pnumber() + 1).
                "-{$this->get_total()}]
                </a>&nbsp;";
            }
            else
            {
                // Нет
                for($i = $page; $i <= $number; $i++)
                {
                    if($number == $i)
                    {
                        if($page == $i)
                        {
                            $return_page .= "nbsp;[".
                                (($i - 1)*$this->get_pnumber() + 1).
                            "-{$this->get_total()}]&nbsp;";
                        }
                        else
                        {
                            $return_page .= "&nbsp;<a href=$_SERVER[PHP_SELF]".
                            "?page=$i{$this->get_parameters()}>
                            [".((($i - 1))*$this->get_pnumber() + 1).
                            "-{$this->get_total()}]
                            </a><&nbsp;";
                        }
                    }
                    else
                    {
                        if($page == $i)
                        {
                            $return_page .= "&nbsp;[".
                                (($i - 1)*$this->get_pnumber() + 1).
                                "-".$i*$this->get_pnumber()."]&nbsp";
                        }
                        else
                        {
                            $return_page .="&nbsp;<a href=$_SERVER[PHP_SELF]".
                            "?page=$i{$this->get_parameters()}>
                            [".(($i - 1)*$this->get_pnumber() + 1).
                            "-".$i*$this->get_pnumber()."]
                            </a>&nbsp;";
                        }
                    }
                }
            }
            return $return_page;
        }

} 