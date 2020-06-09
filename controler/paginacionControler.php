<?php

class PaginacionControl
{
    private static $page;
    private static $range;
    private static $section_size;
    private static $pagination_model;

    public static function config($page, $range, $table, $custom_select = null, $section_size = 5)
    {
        self::$page = (string) ($page);
        self::$range = $range;
        self::$section_size = $section_size;

        if ($custom_select == null && $table != null) {
            self::$pagination_model = new PaginacionModel($table);
        } else {
            self::$pagination_model = new PaginacionModel($custom_select, true);
        }
    }

    public static function MostrarFilas($order_by, $sort = "ASC")
    {
        $page = self::$page;
        $range = self::$range;
        $pagination_model = self::$pagination_model;
        $start = ($page - 1) * $range;
        $rows = $pagination_model->get_rows($start, $range, $order_by, $sort);
        $names = $pagination_model->get_columns_names();
        $result = array(array());

        if ($rows != null) {
            for ($i = 0; $i < count($rows); $i++) {
                for ($j = 0; $j < count($names); $j++) {
                    $result[$i][$names[$j]] = $rows[$i][$j];
                }
            }
        } else {
            for ($j = 0; $j < count($names); $j++) {
                $result[0][$names[$j]] = "Error: vacío";
            }
        }
        return $result;
    }

    public static function data()
    {
        $page = self::$page;
        $range = self::$range;
        $section_size = self::$section_size;
        $pagination_model = self::$pagination_model;
        $actual_section = 1;
        $total_rows = $pagination_model->length();
        $total_pages = ceil($total_rows / $range);
        $total_sections = ceil($total_pages / $section_size);
        $section_count = $section_size;
        $error = false;

        do {
            if ($page > $section_count) {
                $section_count += $section_size;
                $actual_section++;
            }
        } while ($page > $section_count);

        $section_end = $actual_section * $section_size;
        $section_start = ($section_end - $section_size) + 1;

        if ($page > $total_pages || $page <= 0 || !ctype_digit($page)) {

            $error = ($total_rows == 0) ? false : true;

        }

        $pagination_data = array();
        $pagination_data["error"] = $error;
        $pagination_data["anterior"] = $page - 1;
        $pagination_data["siguiente"] = $page + 1;
        $pagination_data["pagina_actual"] = $page;
        $pagination_data["total_paginas"] = $total_pages;
        $pagination_data["inicio_seccion"] = $section_start;
        $pagination_data["final_seccion"] = $section_end;
        $pagination_data["seccion_actual"] = $actual_section;
        $pagination_data["total_seccion"] = $total_sections;
        return $pagination_data;
    }
}
