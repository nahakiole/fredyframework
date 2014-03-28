<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 26.03.14
 * Time: 08:10
 */

namespace View;


interface HTMLGenerator
{

    /**
     * @param $id String The Id and the name attribute for the input field
     * @param $label String The label for the input field
     * @param $value String
     * @param $placeholder String Placeholder html attribute
     * @param $helperText String Text under the input field
     * @param $required Boolean
     * @param $hasError
     * @param $options Array
     * @return HTMLElement
     */
    function getTextfield($id, $label, $value, $placeholder, $helperText, $required, $hasError, $options);

    function getHidden($id, $value, $options);

    /**
     * @param $id String The Id and the name attribute for the input field
     * @param $label String The label for the input field
     * @param $value String
     * @param $placeholder String Placeholder html attribute
     * @param $helperText
     * @param $required
     * @param $hasError
     * @param $options Array
     * @return HTMLElement
     */
    function getTextarea($id, $label, $value, $placeholder, $helperText, $required, $hasError, $options);

    /**
     * @param $id String The Id and the name attribute for the input field
     * @param $label String The label for the input field
     * @param $checked Boolean
     * @param $helperText String Text under the input field
     * @param $required Boolean
     * @param $hasError
     * @param $options Array
     * @return HTMLElement
     */
    function getCheckbox($id, $label, $checked, $helperText, $required, $hasError, $options);

    /**
     * @param $id String The Id and the name attribute for the input field
     * @param $label String The label for the input field
     * @param $values Array
     * @param $helperText String Text under the input field
     * @param $required Boolean
     * @param $hasError
     * @param $options
     * @return HTMLElement
     */
    function getCheckboxes($id, $label, $values, $helperText, $required, $hasError, $options);

    /**
     * @param $id String The Id and the name attribute for the input field
     * @param $label String The label for the input field
     * @param $values Array
     * @param $helperText String Text under the input field
     * @param $required Boolean
     * @param $hasError
     * @param $options
     * @return HTMLElement
     */
    function getRadiobuttons($id, $label, $values, $helperText, $required, $hasError, $options);

    /**
     * @param $id String The Id and the name attribute for the button
     * @param $label String The label for the input field
     * @param $value
     * @param $options
     * @return HTMLElement
     */
    function getButton($id, $label, $value, $options);

    /**
     * @param $id
     * @param $action
     * @param string $method
     * @param array $options
     * @return HTMLElement
     */
    function getForm($id, $action, $method = 'POST', $options = []);
}