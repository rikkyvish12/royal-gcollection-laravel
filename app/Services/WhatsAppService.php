<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    private $whatsappNumber = '8286608983';

    public function sendOtp($mobileNumber, $otp)
    {
        // This is a mock service. In production, you would use Twilio or a WhatsApp API provider.
        Log::info("MOCK WHATSAPP OTP SENT: To $mobileNumber, Code: $otp");
        
        // For local development, we can also flash it to session or just rely on logs.
        session()->flash('otp_debug', "DEBUG: OTP for $mobileNumber is $otp");
        
        return true;
    }

    /**
     * Generate WhatsApp URL for order placement
     * 
     * @param array $cartItems Cart items
     * @param float $total Total amount
     * @param string $shippingAddress Shipping address
     * @param string $paymentMethod Payment method
     * @return string WhatsApp URL
     */
    public function generateOrderUrl($cartItems, $total, $shippingAddress, $paymentMethod = 'COD')
    {
        $message = "🛍️ *NEW ORDER - Royal Collection*\n\n";
        $message .= "━━━━━━━━━━━━━━━━━━\n\n";
        $message .= "*Order Details:*\n";
        
        foreach($cartItems as $id => $item) {
            $message .= "• " . ($item['name'] ?? 'Product') . "\n";
            $message .= "  Qty: " . ($item['quantity'] ?? 1) . " × ₹" . number_format($item['price'] ?? 0, 2) . "\n";
            $message .= "  Subtotal: ₹" . number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 1), 2) . "\n\n";
        }
        
        $message .= "━━━━━━━━━━━━━━━━━━\n\n";
        $message .= "*Total Amount:* ₹" . number_format($total, 2) . "\n\n";
        $message .= "*Payment Method:* " . ($paymentMethod ?? 'COD') . "\n\n";
        $message .= "*Shipping Address:*\n" . ($shippingAddress ?? 'Not provided') . "\n\n";
        
        if(auth()->check()) {
            $user = auth()->user();
            $message .= "*Customer Details:*\n";
            $message .= "Name: " . ($user->name ?? 'N/A') . "\n";
            if($user->phone) {
                $message .= "Phone: " . $user->phone . "\n";
            }
            $message .= "Email: " . ($user->email ?? 'N/A') . "\n\n";
        }
        
        $message .= "━━━━━━━━━━━━━━━━━━\n";
        $message .= "Thank you for shopping with Royal Collection! 👑";
        
        \Log::info('WhatsApp Order Message:', ['message' => $message, 'cartItems' => $cartItems, 'total' => $total]);
        
        $encodedMessage = urlencode($message);
        return "https://wa.me/91{$this->whatsappNumber}?text={$encodedMessage}";
    }

    /**
     * Generate WhatsApp URL for product enquiry
     * 
     * @param object $product Product model
     * @return string WhatsApp URL
     */
    public function generateEnquiryUrl($product)
    {
        $message = "👋 *Product Enquiry - Royal Collection*\n\n";
        $message .= "━━━━━━━━━━━━━━━━━━\n\n";
        $message .= "I'm interested in this product:\n\n";
        $message .= "*Product:* " . ($product->name ?? 'N/A') . "\n";
        $message .= "*Brand:* " . ($product->brand ?? 'N/A') . "\n";
        $message .= "*Price:* ₹" . number_format($product->price ?? 0, 2) . "\n";
        
        // Add product image URL
        if(isset($product->images[0])) {
            $imageUrl = $product->images[0];
            if(!str_starts_with($imageUrl, 'http')) {
                $imageUrl = asset($imageUrl);
            }
            $message .= "\n*Product Image:* " . $imageUrl . "\n";
        }
        
        // Add product page URL
        $productUrl = route('product.detail', $product->id);
        $message .= "*View Product:* " . $productUrl . "\n";
        
        if($product->description) {
            $message .= "\n*Description:*\n" . $product->description . "\n";
        }
        
        if($product->stock_quantity > 0) {
            $message .= "\n*Availability:* In Stock (" . $product->stock_quantity . " units)\n\n";
        } else {
            $message .= "\n*Availability:* Out of Stock\n\n";
        }
        
        $message .= "━━━━━━━━━━━━━━━━━━\n\n";
        $message .= "I would like to know more about this product. Please share additional details.\n\n";
        
        if(auth()->check()) {
            $user = auth()->user();
            $message .= "*My Details:*\n";
            $message .= "Name: " . ($user->name ?? 'N/A') . "\n";
            if($user->phone) {
                $message .= "Phone: " . $user->phone . "\n";
            }
            $message .= "Email: " . ($user->email ?? 'N/A') . "\n";
        }
        
        \Log::info('WhatsApp Enquiry Message:', ['message' => $message, 'product' => $product->toArray()]);
        
        $encodedMessage = urlencode($message);
        return "https://wa.me/91{$this->whatsappNumber}?text={$encodedMessage}";
    }

    /**
     * Get WhatsApp number
     * 
     * @return string
     */
    public function getWhatsAppNumber()
    {
        return $this->whatsappNumber;
    }
}
