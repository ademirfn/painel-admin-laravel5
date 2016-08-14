<?php

if (!function_exists('dateformat')) {

    function dateformat($date, $format = false) {
        if (!$format) {
            $format = 'd/m/Y';
        }
        if (!$date instanceof \DateTime) {
            $date = new DateTime($date);
        }
        return $date->format($format);
    }

}

if (!function_exists('format_date')) {

    function format_date($date) {
        $ex = explode('/', $date);
        return $ex[2] . '-' . $ex[1] . '-' . $ex[0];
    }

}

if (!function_exists('status')) {

    function status($code) {
        $status = '';
        if ($code == 'Y') {
            $status = '<small class="label label-success">ativo</small>';
        } elseif ($code == 'N') {
            $status = '<small class="label label-danger">inativo</small>';
        }
        return $status;
    }

}

if (!function_exists('newsletter')) {

    function newsletter($code) {
        $newsletter = '';
        if ($code == 'Y') {
            $newsletter = '<small class="label label-success">ativo</small>';
        } elseif ($code == 'N') {
            $newsletter = '<small class="label label-danger">inativo</small>';
        }
        return $newsletter;
    }

}

if (!function_exists('log_type')) {

    function log_type($code) {
        $type = '<small class="label label-danger">error type</small>';
        if ($code == 1) {
            $type = '<small class="label label-info">entrada</small>';
        } elseif ($code == 2) {
            $type = '<small class="label label-warning">saída</small>';
        } elseif ($code == 3) {
            $type = '<small class="label label-success">venda</small>';
        }
        return $type;
    }

}

if (!function_exists('featured')) {

    function featured($code) {
        $type = '<small class="label label-default">todos</small>';
        if ($code == 1) {
            $type = '<small class="label label-info">destaque</small>';
        } elseif ($code == 2) {
            $type = '<small class="label label-warning">novidade</small>';
        } elseif ($code == 3) {
            $type = '<small class="label label-success">promoção</small>';
        }
        return $type;
    }

}

if (!function_exists('role')) {

    function role($code) {
        switch ($code) {
            case 1:
                $level = 'root';
                break;
            case 2:
                $level = 'admin';
                break;
            case 3:
                $level = 'editor';
                break;
            case 4:
                $level = 'client';
                break;
            default:
                $level = 'client';
                break;
        }
        return $level;
    }

}

if (!function_exists('pagseguro_status')) {

    function pagseguro_status($code) {
        switch ($code) {
            case 1:
                $level = '<small class="label label-info">pendente</small>';
                break;
            case 2:
                $level = '<small class="label label-default">em análise</small>';
                break;
            case 3:
                $level = '<small class="label label-success" style="background-color:green;">paga</small>';
                break;
            case 4:
                $level = '<small class="label label-success">disponível</small>';
                break;
            case 5:
                $level = '<small class="label label-default" style="background-color:#8B4500;">em disputa</small>';
                break;
            case 6:
                $level = '<small class="label label-warning">devolvida</small>';
                break;
            case 7:
                $level = '<small class="label label-danger">cancelada</small>';
                break;
            case 8:
                $level = '<small class="label label-default" style="background-color:#C71585;">finalizada</small>';
                break;
            default:
                $level = '<small class="label label-default">nenhum</small>';
                break;
        }
        return $level;
    }

}

if (!function_exists('level_category')) {

    function level_category($code) {
        $level = 'subcategoria';
        if ($code == 0) {
            $level = 'categoria';
        }
        return $level;
    }

}

if (!function_exists('percentage')) {

    function percentage($percentage, $value) {
        return ($percentage / 100) * $value;
    }

}

if (!function_exists('checkCPF')) {

    function checkCPF($cpf) {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        $digitA = 0;
        $digitB = 0;
        for ($i = 0, $x = 10; $i <= 8; $i++, $x--) {
            $digitA += $cpf[$i] * $x;
        }
        for ($i = 0, $x = 11; $i <= 9; $i++, $x--) {
            if (str_repeat($i, 11) == $cpf) {
                return false;
            }
            $digitB += $cpf[$i] * $x;
        }
        $somaA = (($digitA % 11) < 2) ? 0 : 11 - ($digitA % 11);
        $somaB = (($digitB % 11) < 2) ? 0 : 11 - ($digitB % 11);

        if ($somaA != $cpf[9] || $somaB != $cpf[10]) {
            return false;
        }
        return true;
    }

}