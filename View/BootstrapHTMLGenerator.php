<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 26.03.14
 * Time: 10:29
 */

namespace View;


class BootstrapHTMLGenerator implements HTMLGenerator
{

    /**
     * @param $id String The Id and the name attribute for the input field
     * @param $label String The label for the input field
     * @param $value String
     * @param $placeholder String Placeholder html attribute
     * @param $helperText String Text under the input field
     * @param $required Boolean
     * @param bool $hasError
     * @param $options Array
     * @return HTMLElement
     */
    function getTextfield($id, $label, $value, $placeholder, $helperText, $required, $hasError = false, $options = [])
    {
        $formGroupClass = $hasError ? 'form-group has-error' : 'form-group';
        $formGroup = new HTMLElement('div', false, [
            'class' => $formGroupClass
        ]);
        $colInput = new HTMLElement('div', false, [
            'class' => 'col-md-8'
        ]);

        $labelElement = new HTMLElement('label', false, [
            'class' => 'col-md-4 control-label text-left',
            'for' => $id
        ]);

        $labelText = new HTMLText($label);
        $labelElement->addChildren($labelText);
        $formGroup->addChildren($labelElement);
        $formGroup->addChildren($colInput);

        $attributes = array_merge([
            'name' => $id,
            'id' => $id,
            'class' => 'form-control input-md',
            'value' => $value,
            'placeholder' => $placeholder,
            'type' => 'text'
        ], $options);

        if ($required) {
            $attributes['required'] = '';
        }
        $element = new HTMLElement('input', true, $attributes);

        $colInput->addChildren($element);
        if (!empty($helperText)) {
            $helperTextElement = new HTMLElement('span', false, [
                'class' => 'help-block'
            ]);
            $helperTextElement->addChildren(new HTMLText($helperText));
            $colInput->addChildren($helperTextElement);
        }

        return $formGroup;
    }

    function getHidden($id, $value, $options = [])
    {

        $attributes = array_merge([
            'name' => $id,
            'id' => $id,
            'value' => $value,
            'type' => 'hidden',
        ], $options);

        $element = new HTMLElement('input', false, $attributes);

        return $element;
    }

    /**
     * @param $id String The Id and the name attribute for the input field
     * @param $label String The label for the input field
     * @param $value String
     * @param $placeholder String Placeholder html attribute
     * @param $helperText
     * @param $required
     * @param bool $hasError
     * @param $options Array
     * @return HTMLElement
     */
    function getTextarea($id, $label, $value, $placeholder, $helperText, $required, $hasError = false, $options = [])
    {
        $formGroupClass = $hasError ? 'form-group has-error' : 'form-group';
        $formGroup = new HTMLElement('div', false, [
            'class' => $formGroupClass
        ]);
        $colInput = new HTMLElement('div', false, [
            'class' => 'col-md-8'
        ]);

        $labelElement = new HTMLElement('label', false, [
            'class' => 'col-md-4 control-label text-left',
            'for' => $id
        ]);

        $labelText = new HTMLText($label);
        $labelElement->addChildren($labelText);
        $formGroup->addChildren($labelElement);
        $formGroup->addChildren($colInput);

        $attributes = array_merge([
            'name' => $id,
            'id' => $id,
            'class' => 'form-control',
            'placeholder' => $placeholder,
        ], $options);

        if ($required) {
            $attributes['required'] = '';
        }

        $element = new HTMLElement('textarea', false, $attributes);
        $element->addChildren(new HTMLText($value));
        $colInput->addChildren($element);

        if (!empty($helperText)) {
            $helperTextElement = new HTMLElement('span', false, [
                'class' => 'help-block'
            ]);
            $helperTextElement->addChildren(new HTMLText($helperText));
            $colInput->addChildren($helperTextElement);
        }

        return $formGroup;
    }

    /**
     * @param $id String The Id and the name attribute for the input field
     * @param $label String The label for the input field
     * @param $checked Boolean
     * @param $helperText String Text under the input field
     * @param $required Boolean
     * @param bool $hasError
     * @param $options Array
     * @return HTMLElement
     */
    function getCheckbox($id, $label, $checked, $helperText, $required, $hasError = false, $options = [])
    {
        $formGroupClass = $hasError ? 'form-group has-error' : 'form-group';
        $formGroup = new HTMLElement('div', false, [
            'class' => $formGroupClass
        ]);
        $colInput = new HTMLElement('div', false, [
            'class' => 'col-md-8'
        ]);

        $labelElement = new HTMLElement('label', false, [
            'class' => 'col-md-4 control-label text-left',
            'for' => $id
        ]);

        $labelText = new HTMLText($label);
        $labelElement->addChildren($labelText);
        $formGroup->addChildren($labelElement);
        $formGroup->addChildren($colInput);


        $row = new HTMLElement('div', false, [
            'class' => 'checkbox'
        ]);

        $attributes = [
            'name' => $id,
            'id' => $id,
            'type' => 'checkbox'
        ];

        $element = new HTMLElement('input', false, $attributes);
        $label = new HTMLElement('label', false);

        $label->addChildren($element);

        $label->addChildren(new HTMLText('Test'));
        $row->addChildren($label);
        $colInput->addChildren($row);

        return $formGroup;
    }

    /**
     * @param $id String The Id and the name attribute for the input field
     * @param $label String The label for the input field
     * @param $values Array
     * @param $helperText String Text under the input field
     * @param $required Boolean
     * @param bool $hasError
     * @param array $options
     * @return HTMLElement
     */
    function getCheckboxes($id, $label, $values, $helperText, $required, $hasError = false, $options = [])
    {
        $formGroupClass = $hasError ? 'form-group has-error' : 'form-group';
        $formGroup = new HTMLElement('div', false, [
            'class' => $formGroupClass
        ]);
        $colInput = new HTMLElement('div', false, [
            'class' => 'col-md-8'
        ]);

        $labelElement = new HTMLElement('label', false, [
            'class' => 'col-md-4 control-label text-left',
            'for' => $id
        ]);

        $labelText = new HTMLText($label);
        $labelElement->addChildren($labelText);
        $formGroup->addChildren($labelElement);
        $formGroup->addChildren($colInput);


        foreach ($values as $checkboxId => $value) {

            $row = new HTMLElement('div', false, [
                'class' => 'checkbox'
            ]);

            $attributes = [
                'name' => $id . "_" . $checkboxId,
                'id' => $id . "_" . $checkboxId,
                'type' => 'checkbox'
            ];

            $element = new HTMLElement('input', false, $attributes);
            $label = new HTMLElement('label', false);

            $label->addChildren($element);

            $label->addChildren(new HTMLText($value['label']));
            $row->addChildren($label);
            $colInput->addChildren($row);
        }


        return $formGroup;
    }

    /**
     * @param $id String The Id and the name attribute for the input field
     * @param $label String The label for the input field
     * @param $values Array
     * @param $helperText String Text under the input field
     * @param $required Boolean
     * @param bool $hasError
     * @param array $options
     * @return HTMLElement
     */
    function getRadiobuttons($id, $label, $values, $helperText, $required, $hasError = false, $options = [])
    {
        $formGroupClass = $hasError ? 'form-group has-error' : 'form-group';
        $formGroup = new HTMLElement('div', false, [
            'class' => $formGroupClass
        ]);
        $colInput = new HTMLElement('div', false, [
            'class' => 'col-md-8'
        ]);

        $labelElement = new HTMLElement('label', false, [
            'class' => 'col-md-4 control-label text-left',
            'for' => $id
        ]);

        $labelText = new HTMLText($label);
        $labelElement->addChildren($labelText);
        $formGroup->addChildren($labelElement);
        $formGroup->addChildren($colInput);


        foreach ($values as $value) {

            $row = new HTMLElement('div', false, [
                'class' => 'radio'
            ]);

            $attributes = [
                'name' => $id,
                'id' => $id,
                'type' => 'radio'
            ];

            $element = new HTMLElement('input', false, $attributes);
            $label = new HTMLElement('label', false);

            $label->addChildren($element);

            $label->addChildren(new HTMLText($value['label']));
            $row->addChildren($label);
            $colInput->addChildren($row);
        }


        return $formGroup;
    }

    /**
     * @param $id String The Id and the name attribute for the button
     * @param $label String The label for the input field
     * @param $value
     * @param $options
     * @return HTMLElement
     */
    function getButton($id, $label, $value, $options = [])
    {
        $formGroup = new HTMLElement('div', false, [
            'class' => 'form-group'
        ]);
        $colInput = new HTMLElement('div', false, [
            'class' => 'col-md-8'
        ]);

        $labelElement = new HTMLElement('label', false, [
            'class' => 'col-md-4 control-label text-left',
            'for' => $id
        ]);

        $labelText = new HTMLText($label);
        $labelElement->addChildren($labelText);
        $formGroup->addChildren($labelElement);
        $formGroup->addChildren($colInput);

        $attributes = [
            'name' => $id,
            'id' => $id,
            'class' => 'btn btn-primary',
            'value' => $value,
            'type' => 'submit'
        ];

        $element = new HTMLElement('input', false, $attributes);

        $colInput->addChildren($element);

        return $formGroup;
    }

    /**
     * @param $id
     * @param $action
     * @param string $method
     * @param array $options
     * @return HTMLElement
     */
    function getForm($id, $action, $method = 'POST', $options = [])
    {
        return new HTMLElement('form', false, array_merge([
            'action' => $action,
            'method' => $method,
            'class' => 'form-horizontal ' . $id . '_form'
        ], $options));
    }
}