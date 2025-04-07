<?php
namespace MagoArab\HideMassActions\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class OrderActions implements ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'cancel', 'label' => __('Cancel')],
            ['value' => 'hold', 'label' => __('Hold')],
            ['value' => 'unhold', 'label' => __('Unhold')],
            ['value' => 'print_invoice', 'label' => __('Print Invoice')],
            ['value' => 'print_packing_slip', 'label' => __('Print Packing Slip')],
            ['value' => 'print_shipping_label', 'label' => __('Print Shipping Label')]
        ];
    }
}