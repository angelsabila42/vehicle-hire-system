# 🚗 Vehicle Hire Management System (Uganda)

A web-based vehicle hire management system built using the Laravel framework.  
The system is designed to manage vehicle rentals, bookings, and user interactions in a structured and efficient way.

---

# 📌 Project Overview

This system allows customers to:
- Register and log in
- Browse available vehicles
- Book vehicles for specific dates
- View booking status and history

It allows administrators to:
- Manage vehicles (Create, Read, Update, Delete)
- View all bookings
- Approve or reject booking requests

---

# ⚙️ Tech Stack

- Laravel (PHP Framework)
- MySQL (via XAMPP)
- Blade Templating Engine
- Vite (Frontend asset bundling)
- Node.js (for frontend assets)

---

# 🧠 System Features

## 👤 Authentication
- User registration and login
- Role-based access (Admin / Customer)
- Secure session handling

## 🚘 Vehicle Management (Admin)
- Add new vehicles
- Edit vehicle details
- Delete vehicles
- Mark vehicles as available/unavailable

## 📅 Booking System
- Select vehicle
- Choose booking dates
- Select pickup location
- Submit booking request

## 🧑‍💼 Admin Booking Management
- View all bookings
- Approve or reject bookings
- Track booking status

## 📜 Booking History
- Users can view their past bookings

---

# 🏗️ Project Architecture

This system follows MVC (Model-View-Controller):

- Models → Handle database logic  
- Views (Blade) → Handle UI  
- Controllers → Handle application logic  

---

# 🚀 Installation Guide

## 1. Clone repository

```bash
git clone <repo-url>
cd vehicle-hire-system