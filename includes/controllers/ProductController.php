<?php

session_start(); // Start the session at the beginning of your script
class ProductController
{
    private $productModel;

    public function __construct(Product $productModel)
    {
        $this->productModel = $productModel;
    }

    public function showProducts()
    {
        return $this->productModel->getProducts();
    }
    public function createProduct($data)
    {
        $validation = $this->validateAndSanitizeProductData($data, $_FILES);

        if (count($validation['errors']) > 0) {
            return $validation['errors'];
        }

        $result = $this->productModel->createProduct($validation['data']);
        header('Location: ../../admin/index.php?message=');
        exit();
    }


    public function updateProduct($data)
    {
        var_dump('a');
        var_dump($_FILES);
        $validation = $this->validateAndSanitizeProductData($data, $_FILES);

        if (count($validation['errors']) > 0) {
            // Store errors in the session
            $_SESSION['errors'] = $validation['errors'];
            // Redirect to the form page
            $this->showUpdateForm($data['ProductoID']);
            exit();
        }

        $validation['data']['ProductoID'] = $data['ProductoID']; // Add the ProductID for update

        $result = $this->productModel->update($validation['data']);
        header('Location: ../../admin/index.php?message=success');
        exit();
    }




    private function validateAndSanitizeProductData($data, $fileData)
    {
        $errors = [];
        $sanitizedData = [];

        // Helper function to check if a string is essentially empty
        $isEssentiallyEmpty = function ($str) {
            return strlen(trim($str)) == 0;
        };

        // Validation and Sanitization for each field
        foreach (['name', 'description', 'category'] as $field) {
            if (empty($data[$field]) || $isEssentiallyEmpty($data[$field])) {
                $errors[$field] = ucfirst($field) . ' is required and cannot be blank';
            } else {
                $sanitizedData[$field] = filter_var($data[$field], FILTER_SANITIZE_STRING);
            }
        }

        // Price validation
        if (!is_numeric($data['price']) || $data['price'] < 0) {
            $errors['price'] = 'Invalid price';
        } else {
            $sanitizedData['price'] = $data['price'];
        }

        // Stock validation
        if (!is_numeric($data['stock']) || $data['stock'] < 0 || intval($data['stock']) != $data['stock']) {
            $errors['stock'] = 'Invalid stock value';
        } else {
            $sanitizedData['stock'] = intval($data['stock']);
        }

        // Image validation and handling
        if (isset($fileData['image_url']) && $fileData['image_url']['error'] == 0) {
            $allowedTypes = ['image/jpeg', 'image/png'];
            $maxSize = 5000000; // 5MB

            if (!in_array($fileData['image_url']['type'], $allowedTypes)) {
                $errors['image'] = 'Invalid image type. Only JPEG and PNG are allowed.';
            } elseif ($fileData['image_url']['size'] > $maxSize) {
                $errors['image'] = 'Image size is too large. Maximum allowed size is 5MB.';
            } else {
                $randomNumber = mt_rand();
                $extension = pathinfo($fileData['image_url']['name'], PATHINFO_EXTENSION);
                $newFileName = "product_" . $randomNumber . '.' . $extension;
                $destination ='../../build/img/products/' . $newFileName;

                if (move_uploaded_file($fileData['image_url']['tmp_name'], $destination)) {
                    $sanitizedData['ImagenURL'] = $newFileName;
                } else {
                    $errors['image'] = 'Error in uploading the image.';
                }
            }
        } else {
            $errors['image'] = 'Image file is required.';
        }

        return ['errors' => $errors, 'data' => $sanitizedData];
    }




    public function showUpdateForm($productId)
    {
        $product = $this->productModel->findById($productId);
        include '../views/update_product_form.php'; // path to your update form view
    }
    public function deleteProduct($id)
    {
        $this->productModel->deleteProduct($id);

        // Redirect to prevent resubmission
        header('Location: ../../admin/index.php');
        exit();
    }
}
