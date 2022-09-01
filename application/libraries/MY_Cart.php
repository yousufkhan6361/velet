<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MY_cart Class
 * @author Muhammaed Uzair Khan (Muhammad.uzair@tradekey.com)
 * @package CI Cart extension . Add some own customizatoin - addons etc
 * Extends CI_cart with the following functionalities:
 *
 */

class MY_Cart extends CI_Cart {

	public $masks = array(
			"remove" => '<a href="javascript:void(0);" class="cart_remove" data-rowid="%s"><i class="fa fa-times fs_large d_inline_m"></i> Remove</a>',
			"add" => '<input type="text" class="f_left color_light cart_qty" name="" value="%d" data-rowid="%s" />',
		);

	public function generate_html($cart_items = array())
	{
		
		global $config;

		// Cart Items....
		$cart_items = $this->contents();
		if(array_filled($cart_items))
		foreach ($cart_items as $rowid => $content) {

			$html .= $this->CI->load->view("widgets/cart_item" , array(
								"content" => $content ,
								"cart_obj" => $this ,
								"rowid" => $rowid ,
							) , true );


		}
		else
		{
			$html .= '<tr style="border-bottom:1px solid #f3f2f2;"><td colspan="100%">No Products in Cart</td></tr>';
		}

		return $html;
	}

	public function generate_basket_html($cart_items = array())
	{
		global $config;

		$html = "" ;

		// Cart Items....
		if(array_filled($cart_items))
		{
			foreach ($cart_items as $rowid => $content) {
				
				// IF ADDON, skip it.
				$html .= $this->CI->load->view("widgets/basket_item" , array(
									"content" => $content ,
									"cart_obj" => $this ,
									"rowid" => $rowid ,
								) , true );

				// Render Addons.
			}
		}
		else
		{
			$html .= '<li style="border-bottom:1px solid #f3f2f2;">No Items in Basket</li>';
		}

		return $html;
	}

	public function update_item($rowid , $qty)
	{
		$item = array();
		$options = $this->product_options($rowid);

		// Check if Qty requested is in range of Qty restricted by admin
		$qty_in_range = ! ( $options[ 'limit_cart' ] && ( $qty > $options[ 'cart_limit' ] ) ) ;

		if(!$qty_in_range)
			end_script_json( array(
					"success"=> false , 
					"msg"=> "You Cannot add more than " . $options[ 'cart_limit' ] .' items of this product'
				) 
			);

		// IF item has Addons to it, we will remove those addons....
		$item[$rowid] = array("rowid"=>$rowid, "qty"=>$qty);
		return $this->update($item);
	}

	public function remove_item($rowid)
	{
		return $this->update_item($rowid,0);
	}
}


/* End of file MY_cart.php */
/* Location: ./application/libraries/MY_cart.php */