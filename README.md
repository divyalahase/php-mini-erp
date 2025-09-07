# Mini ERP - Inventory & Sales Module

A small ERP-style Laravel application to manage **Items, Customers, Sales Orders, and Stock** with role-based authentication.

---

## Features

### Roles & Permissions
- **Admin**
  - Create Companies
  - Create Users & Assign Roles (`admin`, `sales`, `store_manager`)
- **Sales**
  - Create Customers
  - Create Sales Orders (with items)
  - Auto-calculation of Order Total
- **Store Manager**
  - Approve Sales Orders
  - Reduce Stock on Order Approval

### Business Rules
- Item stock cannot go below zero.
- Sales orders must have at least one item.
- Amount = `qty × rate`.
- Stock is deducted on order confirmation.

### Reports
- Pending Sales Orders
- Confirmed Sales Orders
- Item Stock Balance

---

## Installation

1. Clone the repository:

```bash
git clone https://github.com/yourusername/mini-erp.git
cd mini-erp
