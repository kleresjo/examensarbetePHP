<?php

require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/Order.php";


class OrdersDatabase extends Database {

// get_one
public function get_one_by_user_id($user_id){
    {
        $query = "SELECT op.id, op.`order-id`, u.username, os.`user-id`, os.`order-date`, os.`status` FROM `order-products` AS op
        JOIN orders AS os ON op.`order-id` = os.id 
        JOIN users AS u ON os.`user-id` = u.id
        WHERE os.`user-id` = ?
        group by  op.`order-id`";


        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $db_orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $orders = [];

        foreach ((array)$db_orders as $db_order) {
            $order = new Order(
                $db_order["user-id"],
                $db_order["status"],
                $db_order["order-date"],
                $db_order["order-id"]
            );
            $orders[] = $order;
        }
        return $orders;
    }
}

// get_all

public function get_all(){
    $query = "SELECT * FROM `orders`";
    $stmt = mysqli_prepare($this->conn, $query);
    $stmt->execute();
    $result = $stmt->get_result();
    $db_orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $orders = [];

    foreach ($db_orders as $db_order) {
        $orders[] = new Order(
            $db_order["user-id"],
            $db_order["status"],
            $db_order["order-date"],
            $db_order["id"]
        );
    }
    return $orders;
}

// get order by user id

public function get_order_by_user_id($user_id)
{
    $query = "SELECT op.id, op.`order-id`, u.username, o.`user-id`, o.`order-date`, o.`status` FROM `order-products` AS op
    JOIN orders AS o ON op.`order-id` = o.id 
    JOIN users AS u ON o.`user-id` = u.id
    WHERE o.`user-id` = ?";

    $stmt = mysqli_prepare($this->conn, $query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $db_orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $orders = [];

    foreach ((array)$db_orders as $db_order) {

        $order = new Order(
            $db_order["user-id"],
            $db_order["status"],
            $db_order["order-date"],
            $db_order["order-id"]
        );
        $orders[] = $order;
    }
    return $orders;
}

 // create beställning
 
    public function create(Order $order)
    {
        $query = "INSERT INTO `orders` (`user-id`, `status`, `order-date`) VALUES (?,?,?)";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("iss", $order->user_id, $order->status, $order->order_date);
        $success = $stmt->execute();

        if ($success) {
            return $stmt->insert_id;
        }
        return false;
    }

    public function create_order($order_id, $product_id)
    {
        $query = "INSERT INTO `order-products` (`order-id`, `product-id`) VALUES (?,?)";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("ii", $order_id, $product_id);
        $success = $stmt->execute();

        return $success;
    }

    // update beställning

    public function update_order_status($id, $status)
    {
        $query = "UPDATE `orders` SET `status` = ? WHERE `id` = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("si", $status, $id);
        $success = $stmt->execute();
        return $success;
    }

    // delete beställning 

    public function delete($id)

    {
        $query = "DELETE FROM `orders` WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("i", $id);
        $success = $stmt->execute();

        return $success;
    }
}
?>