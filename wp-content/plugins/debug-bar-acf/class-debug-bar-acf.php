<?php

class Debug_Bar_Acf extends Debug_Bar_Panel {
    function init() {
        $this->title( __('Advanced Custom Fields', 'debug-bar') );
        // add_action('load_template', array( $this, 'log_template_load' ) );
        // add_action('template_include', array( $this, 'log_template_load' ) );
        // add_action('locate_template', array( $this, 'log_template_load' ) );
    }

    function log_template_load( $template ) {
        $this->templates[] = $template;
        return $template;
    }

    function prerender() {

    }

    function render() {
        global $post;

        // If required info isn't present, exit early.
        if (!isset($post) || empty($post)) {
            echo "No custom fields.";
            return;
        }

        $fields = get_fields($post->ID);

        echo "<div id='acf'>";
        echo "<h3>Advanced custom Fields</h3>";
        if (is_array($fields)) {
            echo '<table class="table table-bordered table-striped">';
            foreach($fields as $fieldName => $fieldValue) {
                if ($fieldValue == FALSE) {
                    continue;
                }
                echo '<tr>';
                echo '<th>' . $fieldName . '</th>';
                echo '<td><pre>';
                var_dump($fieldValue);
                echo '</pre></td>';
                echo '</tr>';
            }
            echo '</table>';
        }
        else {
            echo "No custom fields.";
        }
        echo "</div>";
    }
}
