# Online Tutoring Marketplace: Booking & Live Classes

> **The World-Class Online Tutoring Marketplace & Institutional Live Learning Operating System**  
> *Built with PHP 8.3+, Laravel 11, Filament v3, MySQL 8 / SQLite, and Redis.*

---

## 🌟 Architectural Highlights

- **Modular Monolith**: All features are organized into 50 toggleable modules located in `app/Modules/<ModuleName>` with strict dependency graphs.
- **Multi-Tenancy & Multi-Branch**: Built-in tenant scoping (`business_id` and `branch_id`) supporting both single business operations with physical/virtual branches and multi-tenant SaaS mode.
- **Role-Based Filament Panels**: 11 dedicated, secure Filament panels tailored for each stakeholder.
- **Mandatory Package Ecosystem**: Seamlessly integrated behind clean internal service adapters.
- **Universal Multilingual & RTL**: Multilingual Unicode slugs, RTL support (Arabic, Urdu), and Unicode PDF rendering in any script (Bangla, Arabic, Hindi, CJK).
- **Fast, Secure & Production-Ready**: Caching, Redis queues, Horizon, Drutogoti APM profiling, and Spatie RBAC.

---

## 📦 Mandatory Ecosystem Packages

Every mandatory package is integrated behind a dedicated internal service adapter:

| Package | Service Adapter | Purpose & Capabilities |
| :--- | :--- | :--- |
| **`imrandevbd/drutogoti`** | `App\Services\Performance\PerformanceService` | Zero-overhead APM profiler for slow queries, N+1 detection, and cache/image optimization. |
| **`imrandevbd/laravel-admin-panel`** | `App\Services\AdminPanel\AdminPanelService` | AI-powered admin dashboard foundation with dynamic themes, palettes, and widgets. |
| **`imrandevbd/laravel-ai-catalog`** | `App\Services\Catalog\CatalogScraperService` | Scrapes and normalizes educational syllabi, exam dates, curriculum topics, and tutor data. |
| **`imrandevbd/laravel-ai-hub`** | `App\Services\Ai\AiService` | Multi-provider AI gateway (Gemini, OpenAI, Claude, DeepSeek, Groq, Ollama) with failover and chat sessions. |
| **`imrandevbd/laravel-attendance-hub`** | `App\Services\Attendance\AttendanceService` | Universal hardware interface for biometric, RFID, and facial recognition physical attendance devices. |
| **`imrandevbd/laravel-unicode-pdf`** | `App\Services\Pdf\PdfService` | Universal Unicode PDF engine with RTL shaping and complex font fallback for Bangla, Arabic, etc. |
| **`imrandevbd/laravel-universal-slug`** | `App\Services\Slug\SlugService` | Universal Unicode-safe SEO slugs with 301 history tracking, reserved path protection, and locale scoping. |

---

## 👥 Role-Based Panels (11 Filament Panels)

| Panel | URL Path | Primary Audience & Purpose |
| :--- | :--- | :--- |
| **Super Admin** | `/super-admin` | Platform owner: businesses, SaaS plans, global modules, and system health. |
| **Business Admin** | `/admin` | Business owner/admin: module center, setup wizard, branch management, and settings. |
| **Branch Manager** | `/branch` | Campus manager: local schedules, room allocation, and physical attendance devices. |
| **Tutor** | `/tutor` | Tutors: profile, availability calendar, bookings, live classes, whiteboard, and earnings. |
| **Student** | `/student` | Learners: search tutors, book sessions, join live classroom, homework, and quizzes. |
| **Guardian / Parent** | `/guardian` | Parents: child oversight, payment approvals, attendance logs, and monitored chats. |
| **Support & Moderation** | `/support` | Support agents & moderators: helpdesk tickets, dispute resolution, and content flags. |
| **Finance** | `/finance` | Accountants: payments, tutor wallets, payout requests, escrow release, and tax invoices. |
| **Content & CMS** | `/content` | Content editors: blog posts, categories, FAQs, and curriculum catalogs. |
| **Institution** | `/institution` | Schools & corporate buyers: bulk student seats, batch classes, and consolidated billing. |
| **Affiliate & Partner** | `/affiliate` | Marketing partners: referral links, conversion tracking, and affiliate commission payouts. |

---

## 🔑 Demo Accounts

All demo accounts use the standard password: **`password`**

| Role | Demo Email | Access Panel |
| :--- | :--- | :--- |
| **Super Admin** | `superadmin@demo.test` | `/super-admin` |
| **Business Owner / Admin** | `owner@demo.test` | `/admin` |
| **Branch Manager** | `branch@demo.test` | `/branch` |
| **Tutor** | `tutor1@demo.test` | `/tutor` |
| **Student** | `student1@demo.test` | `/student` |
| **Guardian / Parent** | `guardian1@demo.test` | `/guardian` |
| **Support Agent** | `support@demo.test` | `/support` |
| **Moderator** | `moderator@demo.test` | `/support` |
| **Finance Manager** | `finance@demo.test` | `/finance` |
| **Content Manager** | `content@demo.test` | `/content` |
| **Academic Coordinator** | `academic@demo.test` | `/content` & `/branch` |
| **Institution Admin** | `institution@demo.test` | `/institution` |
| **Affiliate Partner** | `affiliate@demo.test` | `/affiliate` |

---

## 🚀 Installation & Quick Start

### 1. Requirements
- PHP 8.3 or higher with extensions: `pdo_sqlite` or `pdo_mysql`, `mbstring`, `intl`, `redis`, `gd`, `xml`
- Composer 2.x
- Redis server
- Node.js 20+ & npm

### 2. Setup Commands
```bash
# Clone and enter directory
cd /home/imran/project/new/online-tutoring-marketplace-booking-and-live-classes

# Install PHP dependencies
composer install

# Configure environment
cp .env.example .env
php artisan key:generate

# Run migrations and seed foundational demo data
php artisan migrate:fresh --seed

# Run tests to verify setup
php artisan test
```

### 3. Running Services
```bash
# Start Web Server
php artisan serve

# Start Queue Worker / Horizon
php artisan horizon

# (Optional) Dev assets build
npm install && npm run build
```

---

## 🧩 Module Management & Presets

The **Module Center** (`/admin/module-center`) allows business owners to toggle features on or off on the fly. Turning off a module immediately disables its navigation, routes, API endpoints, and scheduled jobs, while preserving existing data.

Available presets:
1. **Solo Tutor**: 1:1 lessons, calendar availability, instant booking, and reviews.
2. **Tutoring Marketplace**: Multi-tutor directory, student/guardian portal, escrow wallets, and commission payouts.
3. **Coaching Center**: Batch cohorts, physical attendance machine integration, timetables, and quizzes.
4. **School / University**: Multi-grade curriculum, section allocations, assignments, and report cards.
5. **Language Academy**: Interactive whiteboards, lesson packages, speech AI assistant, and certificates.
6. **Exam-Prep Academy**: Practice question bank, mock tests, AI diagnostics, and gamified streaks.
7. **Corporate Training**: B2B bulk employee seats, compliance tracking, and corporate billing.
8. **Full Enterprise Suite**: All 50 marketplace, live teaching, fintech, AI, and operations modules unlocked.

---

## 👨‍💻 Developer Identity & Verification

- **Author**: Imran Ahmed
- **Email**: me@imrandev.bd
- **Website**: [https://imrandev.bd](https://imrandev.bd)
