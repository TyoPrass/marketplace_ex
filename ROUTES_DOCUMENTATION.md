# 📚 Routes Documentation

## Public Routes

### Landing Page

```
GET  /                          → Home page with featured products
```

### Products (Public Access)

```
GET  /products                  → Browse all products catalog
GET  /products/{id}             → View product detail
```

## Authenticated Routes

### Buyer Routes

**Prefix:** `/buyer`  
**Middleware:** `auth`, `buyer`

```
GET   /buyer/orders             → List all buyer's orders
GET   /buyer/orders/{id}        → View order detail
POST  /buyer/orders             → Create new order (purchase product)
```

**Order Form Data:**

- product_id (required)
- quantity (required, min: 1)
- shipping_address (required)
- phone (required)

### Seller Routes

**Prefix:** `/seller`  
**Middleware:** `auth`, `seller`

```
GET     /seller/products              → List all seller's products
GET     /seller/products/create       → Show create product form
POST    /seller/products              → Store new product
GET     /seller/products/{id}/edit    → Show edit product form
PUT     /seller/products/{id}         → Update product
DELETE  /seller/products/{id}         → Delete product
```

**Product Form Data:**

- name (required)
- brand (required)
- description (required)
- processor (required)
- ram (required)
- storage (required)
- gpu (optional)
- screen_size (required)
- price (required, numeric, min: 0)
- stock (required, integer, min: 0)
- image (optional, image file, max: 2MB)
- status (active/inactive) - only on edit

### Admin Routes

**Prefix:** `/admin`  
**Middleware:** `auth`, `admin`

```
GET   /admin/dashboard                    → Admin dashboard with statistics
GET   /admin/orders                       → List all orders
GET   /admin/orders/{id}                  → View order detail
POST  /admin/orders/{id}/verify           → Verify or cancel order
POST  /admin/orders/{id}/update-status    → Update order status
```

**Verify Order Data:**

- status (required: verified/cancelled)
- notes (optional)

**Update Status Data:**

- status (required: processing/shipped/completed/cancelled)

## Order Status Flow

```
pending → verified → processing → shipped → completed
   ↓
cancelled (can happen from pending or verified)
```

**Status Descriptions:**

- `pending`: Order created, waiting for admin verification
- `verified`: Admin verified the order
- `processing`: Order is being processed/prepared
- `shipped`: Order has been shipped to buyer
- `completed`: Order successfully delivered
- `cancelled`: Order cancelled by admin

## Authentication Routes

```
GET   /login                    → Login page
POST  /login                    → Authenticate user
GET   /register                 → Registration page
POST  /register                 → Create new user
POST  /logout                   → Logout user
```

**Note:** These routes are provided by Laravel Breeze after installation.

## Middleware Summary

| Route Group | Middleware   | Access       |
| ----------- | ------------ | ------------ |
| `/`         | none         | Public       |
| `/products` | none         | Public       |
| `/buyer/*`  | auth, buyer  | Buyers only  |
| `/seller/*` | auth, seller | Sellers only |
| `/admin/*`  | auth, admin  | Admins only  |

## Response Redirects

### Success Actions

- Product created → `/seller/products` with success message
- Product updated → `/seller/products` with success message
- Product deleted → `/seller/products` with success message
- Order created → `/buyer/orders` with success message & order number
- Order verified → `/admin/orders` with success message
- Status updated → `/admin/orders/{id}` with success message

### Error Scenarios

- Unauthorized access → 403 Forbidden
- Invalid product owner → 403 Forbidden
- Insufficient stock → Redirect back with error message
- Validation failed → Redirect back with validation errors
