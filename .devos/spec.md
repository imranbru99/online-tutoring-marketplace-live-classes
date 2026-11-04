================================================================================
[MANDATORY TARGET PROJECT DIRECTORY: /home/imran/project/new/online-tutoring-marketplace-booking-and-live-classes]
You MUST create, initialize, build, and write all project files, directories, code,
and configurations directly inside:
/home/imran/project/new/online-tutoring-marketplace-booking-and-live-classes

DO NOT create or modify files in any other workspace (such as dev-os).
All shell commands (composer, artisan, npm, git, etc.) must be executed with
working directory inside: /home/imran/project/new/online-tutoring-marketplace-booking-and-live-classes
Ask for clarification if required information or authorization is missing.
================================================================================

MASTER PROMPT FOR AI CODE AGENT
Project: Online Tutoring Marketplace: Booking and Live Classes
Stack: PHP 8.3+, Laravel 11/12, Filament 3/4, MySQL 8, Redis

0. YOUR ROLE AND MISSION
You are a senior full-stack engineer and product architect. Build a complete, production-ready, end-to-end business application named "Online Tutoring Marketplace: Booking and Live Classes" using PHP Laravel + Filament.
This is meant to be the best tutoring marketplace in the world. It must be a complete business solution, not a demo skeleton. Any tutoring business (a solo tutor, a coaching center, a school, a university, a language academy, a large marketplace with thousands of tutors) must be able to run its entire operation on it, turning modules ON or OFF depending on what they need.
Hard requirements:
Complete, working code. No placeholders, no "TODO", no "implement later", no fake lorem-only screens in the admin or tutor/student areas.
Modular architecture: every feature group is a module that can be enabled/disabled per business (and per branch). A disabled module disappears from navigation, routes, API, scheduled jobs, permissions, public pages, and dashboards.
Multi-user-type system with role-based panels.
Several public pages showcasing every feature (also mirrored in README.md).
Demo data and demo users for every role so the whole system can be explored right after install.
Multi-branch, multi-language, multi-currency, multi-timezone from day one.
Must be fast, secure, tested, and documented.
Work in phases (Section 20). After each phase: run migrations, seeders, and tests, fix every error, and only then continue. Never leave the project in a broken state.

1. MANDATORY PACKAGES (use them, do not reinvent)
Before writing any code, open each package's Packagist/GitHub page and README, read the real installation steps, config keys, facades, and APIs. Do not invent methods. If something is unclear, read the package source in vendor/ after install.
Purpose
Package
How to use it here
Speed
imrandevbd/drutogoti
Install and enable for performance optimization (caching, response speed, query/asset optimization as the package provides). Apply to public pages and panels.
Dashboard
imrandevbd/laravel-admin-panel
Use as the dashboard foundation/widgets/layout alongside Filament panels. Follow its README for integration.
Scraping online data
imrandevbd/laravel-ai-catalog
Use for importing/scraping online data: subject catalogs, curriculum/syllabus lists, course content ideas, tutor profile enrichment (from public sources, with consent and robots/ToS respect), study material discovery.
Any AI provider
imrandevbd/laravel-ai-hub
All AI features go through this. Provider-agnostic (OpenAI, Gemini, others). No direct vendor SDK calls scattered in code.
Attendance machines
imrandevbd/laravel-attendance-hub
Integrate for physical attendance devices (biometric/RFID/face) at tutoring centers, in-person/hybrid classes, and staff attendance.
PDF in any language
imrandevbd/laravel-unicode-pdf
All PDFs (invoices, receipts, certificates, report cards, timetables, contracts, payout statements) must use this so Bangla, Arabic, Hindi, Chinese, etc. render correctly.
Slugs in any language
imrandevbd/laravel-universal-slug
All slugs (tutors, subjects, courses, blog posts, pages, categories, cities) use this so non-Latin titles produce valid slugs.

Rules:
Wrap each package behind a small internal service/adapter class (e.g. App\Services\Pdf\PdfService, App\Services\Ai\AiService, App\Services\Attendance\AttendanceService) so the rest of the app depends on our interface, not the package directly.
Add a System Health page in the admin showing the status of each package (installed, version, configured, last successful use).
Document each package's role in README.md.
Also use well-maintained standard packages where needed (Spatie permission, Spatie media library, Spatie activitylog, Spatie translatable, Laravel Sanctum, Laravel Horizon, Laravel Reverb or Pusher, Laravel Socialite, Laravel Cashier where appropriate, Maatwebsite Excel, etc.). Verify that each supports the installed Laravel/Filament versions.

2. ARCHITECTURE
2.1 Structure
Laravel modular monolith. Each module lives in app/Modules/<ModuleName>/ (or modules/ with a PSR-4 autoload) containing: Models, Migrations, Filament (Resources, Pages, Widgets, RelationManagers), Http (controllers, requests, resources), Livewire, Policies, Services, Jobs, Events, Listeners, Routes, Views, Lang, Seeders, Tests, and a module.json manifest.
Each module.json declares: key, name, description, version, dependencies (other module keys), permissions, settings schema, public pages, navigation items, scheduled tasks, demo seeders.
A ModuleManager service: lists modules, checks dependencies (cannot disable a module others depend on without warning), caches state, and exposes Module::enabled('live-classes').
Module state is stored per business (tenant) and overridable per branch.
2.2 Multi-tenancy and multi-branch
Support single business with many branches and multi-tenant SaaS (many businesses). Use a clean tenant scoping layer (global scopes + tenant_id, branch_id where needed). Make the mode switchable in settings.
Every business has: profile, branding (logo, colors, favicon), domain/subdomain, default language/currency/timezone, module toggles, payment settings, email/SMS/WhatsApp settings, SEO settings.
Branch-level data separation, branch managers, inter-branch reports, consolidated reports for owners.
2.3 Panels (Filament)
Create separate Filament panels, each with its own login, theme, and navigation:
Super Admin panel (platform owner: businesses, plans, modules, global settings, system health)
Business Admin panel (owner/admin of one tutoring business)
Branch Manager panel
Tutor panel
Student panel
Guardian/Parent panel
Support & Moderation panel (support agents, moderators, dispute resolvers)
Finance panel (accountants: payments, payouts, refunds, tax)
Content panel (content managers: blog, pages, SEO, course content)
Institution panel (schools/companies that buy classes for many students)
Affiliate/Partner panel (referral and affiliate partners)
Panels must only show resources from enabled modules and permitted roles.
2.4 Performance
Apply imrandevbd/drutogoti.
Redis for cache, queues, sessions; Horizon for queue monitoring.
Eager loading everywhere, indexed columns, pagination, cached settings/module state, cached public pages with smart invalidation.
Queue every heavy action: emails, SMS, PDFs, AI calls, recordings processing, imports, scraping, payouts.
Octane-ready code (no static state leaks).
2.5 Security
Spatie roles/permissions with fine-grained policies; every Filament resource and API endpoint authorized.
2FA (TOTP, email OTP), device/session management, login throttling, suspicious login alerts.
Encrypted sensitive fields, signed URLs for recordings/downloads, CSRF, XSS-safe rendering, rate limiting, audit log (Spatie activitylog) on all critical actions.
GDPR-style tools: data export, account deletion, consent logs, cookie banner.
Child safety: guardian approval for minors, restricted messaging for minors, session visibility to guardian, moderation and reporting.
Never store raw card data; use gateway tokenization.

3. USER TYPES (ROLES)
Implement all of these with permissions, dashboards, and demo users:
Super Admin (platform level)
Business Owner / Admin
Branch Manager
Tutor (independent, or belonging to an institution/branch)
Student (adult learner or child)
Guardian/Parent (linked to one or many students)
Support Agent
Moderator / Dispute Resolver
Finance Manager / Accountant
Content Manager
Academic Coordinator (curriculum, quality, tutor review)
Institution Admin (school/company managing bulk students)
Affiliate / Referral Partner
Guest (public visitor)
Features per type: own dashboard, profile, notification preferences, language/timezone, KYC where relevant, activity history, and role switching for users with multiple roles.

4. MODULE CATALOG (EVERYTHING; each is toggleable)
Build every module below. Each has full CRUD, Filament resources, relevant public/API surfaces, permissions, settings, notifications, reports, demo data, and tests.
Core (always on, cannot be disabled)
M01 Core Platform: businesses, branches, users, roles/permissions, settings, module manager, audit log, notifications engine, media, localization, currency, timezone, health page, backup status, import/export center.
Marketplace and People
M02 Tutor Management: profile (bio, intro video, photo, subjects, levels, languages, experience, education, certificates, teaching style, hourly rate, trial rate, group rate), verification badges, KYC upload, background-check status, onboarding wizard, approval workflow, profile completeness score, featured/boosted tutors, tutor tiers (new, pro, elite), vacation mode, profile SEO URL (universal slug).
M03 Student Management: profile, learning goals, level, school/grade, learning style, preferred times, parent link, enrollment history, progress timeline, notes, tags, wishlist/favorite tutors.
M04 Guardian/Parent Portal: link multiple children, approve bookings, pay on behalf, view schedules, see attendance and progress, receive reports, chat with tutors (monitored), set spending limits and screen-time/booking limits.
M05 Subjects, Levels and Curriculum Catalog: categories, subjects, topics, grade levels, exam boards (IB, A-Level, GCSE, SAT, ACT, HSC, SSC, NCTB, CBSE, ICSE, TOEFL, IELTS, GRE, GMAT, etc.), languages, skill tags. Use laravel-ai-catalog to scrape/import catalogs and AI to normalize them. Admin approval before publishing.
M06 Search, Discovery and Matching: advanced search and filters (subject, level, price, rating, language, availability, country, gender, verified, trial available), sort, saved searches, map/location for in-person lessons, AI tutor matching (via laravel-ai-hub) from student goals, "request a tutor" job board where tutors bid/respond, similar tutors, trending subjects.
Scheduling and Booking
M07 Availability and Calendar: weekly recurring availability, exceptions, holidays, buffers, min notice, max bookings/day, timezone auto-conversion, calendar views (day/week/month), Google/Outlook/iCal sync, ICS export, conflict detection.
M08 Booking Engine: instant booking and request-and-approve modes, 1:1 lessons, trial lessons, packages, recurring series, reschedule and cancel policies (configurable windows and fees), no-show handling, waitlist, booking status workflow (pending → confirmed → in progress → completed → reviewed / cancelled / no-show / disputed), reminders (email/SMS/WhatsApp/push), booking notes, add-ons.
M09 Group Classes and Cohorts: scheduled group classes, seat limits, min seats to run, waitlist, recurring cohorts, open enrollment, per-seat pricing, private group booking, class pages.
M10 Courses and Programs: multi-lesson courses (live, recorded, or hybrid), curriculum builder (sections, lessons, resources), drip schedule, prerequisites, course landing pages, bundles, certificates on completion, course reviews, instructor revenue share.
M11 Packages and Subscriptions: lesson bundles (5/10/20 hours), monthly subscriptions, auto-renew, pause/resume, rollover rules, expiry, upgrade/downgrade, proration, dunning (failed payment retries), gift cards and credits.
Live Teaching
M12 Live Classroom: built-in video classroom with pluggable drivers (Jitsi, BigBlueButton, LiveKit, Zoom, Google Meet, Daily). Features: join links, waiting room, lobby device test, screen share, chat, hand raise, breakout rooms, polls, attendance auto-capture, session timer, reconnection handling, low-bandwidth mode, mobile friendly. Driver selected in settings; interface-based so more can be added.
M13 Interactive Whiteboard: real-time collaborative whiteboard (Reverb/WebSockets), pen/shapes/text/images/PDF import, math/equation and code blocks, multi-page, save and export boards to PDF/image, attach to lesson record.
M14 Recordings and Replays: record sessions, store (local/S3/compatible), processing queue, consent capture, guardian visibility, secure signed playback, retention policies, auto-transcripts and AI summaries, download controls, chapter markers.
M15 Lesson Notes, Resources and Library: shared files, lesson notes, homework attachments, folder library, tutor resource marketplace (sell worksheets/notes), versioning, tagging, storage quotas.
M16 Assignments and Homework: create, assign, due dates, submissions (files/text/audio/video), grading, rubric, feedback, resubmission, late rules, plagiarism hint (AI), parent visibility.
M17 Quizzes and Assessments: question bank (MCQ, multi-select, short, long, fill-blank, matching, math), timers, randomization, auto-grading, manual grading, AI question generation (via laravel-ai-hub), diagnostic placement tests, exam mock tests, result analytics, certificates.
M18 Progress, Learning Plans and Reports: learning goals, milestones, tutor lesson summaries, progress charts, skill mastery map, term/monthly report cards (PDF via laravel-unicode-pdf), parent reports, AI progress insights.
AI (all through imrandevbd/laravel-ai-hub)
M19 AI Study Assistant: 24/7 AI tutor chat for students (subject-aware, age-appropriate guardrails), explain-this, step-by-step solver, practice generation, flashcards, summaries, voice and text, language selection, usage limits per plan, safety filters, parent-visible logs.
M20 AI Tutor Tools: lesson plan generator, quiz generator, homework feedback drafts, post-lesson summary, student progress narrative, translation of materials, auto-generated tutor bio improvement, response suggestions in chat.
M21 AI Admin Tools: AI moderation of profiles/reviews/messages, fraud and off-platform-contact detection, demand forecasting, churn prediction, pricing suggestions, support reply drafts, SEO content drafts, tutor quality scoring.
M22 AI Catalog and Scraper: using laravel-ai-catalog, scheduled and manual jobs to collect public data (syllabi, exam dates, curriculum topics, education news), review queue, dedupe, source attribution, compliance settings (robots.txt, rate limiting, allowed domains).
Money
M23 Payments: gateway drivers: Stripe, PayPal, SSLCommerz, bKash, Nagad, Rocket, Razorpay, Paystack, Flutterwave, Paddle, bank transfer, cash/offline with approval. Cards, wallets, local methods, saved methods, 3DS, webhooks, idempotency, retries, payment links, installments/EMI option, multi-currency with FX rates.
M24 Wallet and Credits: student wallet, top-up, balance, credit expiry, tutor earnings wallet, transaction ledger (double-entry), gift cards, promotional credits.
M25 Commission, Payouts and Revenue Share: per-tutor/tier/subject commission rules, escrow-style holding until lesson completion, payout schedules, payout methods (bank, PayPal, bKash, Wise, etc.), payout requests and approval, tax withholding, payout statements (PDF), instructor/institution revenue split.
M26 Invoicing, Tax and Accounting: invoices, receipts, credit notes, VAT/GST/sales tax rules per country, tax IDs, numbering series per branch, PDF in any language, accounting export (CSV, QuickBooks/Xero-ready), P&L, reconciliation, refunds ledger.
M27 Coupons, Promotions and Pricing: coupon codes, first-lesson discounts, seasonal campaigns, volume discounts, tutor-funded discounts, dynamic pricing rules, flash sales, bundles.
M28 Refunds and Disputes: refund policy engine, partial/full refunds, dispute opening, evidence upload, moderator resolution, chargeback tracking, outcome logs.
Growth and Communication
M29 Messaging and Chat: real-time chat student↔tutor, guardian-visible threads for minors, attachments, voice notes, read receipts, templates, off-platform-contact detection and masking, block/report, message search, retention rules.
M30 Notifications Center: in-app, email, SMS, WhatsApp, web push, mobile push; templates per language; user preferences; quiet hours; digest; delivery logs; provider drivers (SMTP, SES, Mailgun, Twilio, local BD SMS gateways, WhatsApp Cloud API).
M31 Reviews and Ratings: post-lesson reviews, multi-criteria ratings, verified-lesson badge, tutor replies, moderation queue, AI spam/abuse detection, rating-based ranking, testimonials widget, structured data for SEO.
M32 Referrals and Affiliates: referral codes, rewards (credit/cash), multi-level optional, affiliate dashboard, tracking links and cookies, payouts, fraud checks, marketing assets.
M33 Marketing and CRM: leads, lead sources, pipeline (new → contacted → trial → paying), tasks, notes, email/SMS campaigns, segments, drip automation, abandoned booking recovery, UTM tracking, landing page builder, popups, NPS/CSAT surveys.
M34 Loyalty and Gamification: points, badges, streaks, levels, leaderboards (opt-in), rewards store, achievement certificates.
M35 Blog, CMS and SEO: blog, categories, pages, FAQs, testimonials, page builder blocks, SEO meta per page, sitemap.xml, robots.txt, Open Graph, schema.org (Course, Person, Review, FAQ, LocalBusiness), redirects, universal slugs, multilingual content, programmatic SEO pages (subject × city × level) generated from catalog.
M36 Events and Webinars: free/paid webinars, workshops, open days, exam-prep bootcamps, registration, reminders, replay, certificates.
Operations and Institutions
M37 Attendance: automatic attendance from live sessions, manual marking, QR check-in, and physical machine integration through imrandevbd/laravel-attendance-hub (biometric, RFID, face devices) for in-person/hybrid centers and staff; late/absent rules, reports, guardian alerts, attendance certificates, device management page and sync logs.
M38 Institution and Bulk Management: schools/companies/NGOs buy seats or hours for many learners, bulk student import (Excel/CSV), class/section/batch, teacher assignment, institution dashboards, consolidated billing, institution-level reports, sub-admins.
M39 Timetable and Batch Management: weekly timetable builder, batch/class/section, room (virtual/physical) allocation, substitute tutor, holiday calendar, timetable PDF.
M40 Staff and HR (lightweight): staff directory, tutor contracts, onboarding checklist, leave, payroll for salaried tutors (salary, bonus, deduction), payslips PDF, performance reviews, staff attendance (via attendance hub).
M41 Support Desk and Helpdesk: tickets (email/web/chat), SLA, priorities, categories, canned replies, assignment rules, knowledge base, live chat widget, AI reply suggestions, CSAT.
M42 Trust, Safety and Compliance: KYC and identity checks, background-check records, profile approval queue, content moderation, report center, incident log, minors protection policies, terms/policy versioning with acceptance logs, data retention, consent management.
M43 Certificates and Credentials: templates, auto-issue on course/test completion, QR verification page, PDF in any language, LinkedIn-share, tutor credential badges.
M44 Analytics, Reports and BI: dashboards per role (via laravel-admin-panel + Filament widgets): GMV, revenue, commission, active tutors/students, booking funnel, retention cohorts, tutor utilization, subject demand, geo heatmap, NPS, refund rate, LTV/CAC, payout liability, attendance rates. Scheduled report emails, CSV/Excel/PDF export, saved filters.
M45 API and Integrations: REST API (Sanctum + versioned /api/v1), OpenAPI docs, webhooks (outgoing, signed), API keys per business with scopes, Zapier/Make-friendly events, Google Calendar, Zoom, Slack, Google Analytics, Meta Pixel, GTM, WhatsApp, SMS gateways.
M46 Mobile and PWA: installable PWA with offline schedule view, push notifications, responsive design; API fully ready for native Flutter/React Native apps; deep links for join-class.
M47 Localization: UI translations (English, Bangla, Arabic with RTL, Hindi, Urdu, Spanish, French, German, Portuguese, Chinese, Indonesian, Turkish minimum), content translation for catalog/blog/pages, language switcher, per-user language, AI-assisted translation (via laravel-ai-hub) with admin review.
M48 Backup, Import/Export and Data Tools: scheduled backups, one-click export of business data, import wizards (tutors, students, subjects, bookings), data anonymization for demo.
M49 Plans and Billing (SaaS mode): plans for businesses (features, module sets, limits), trial, upgrade/downgrade, invoices to tenants, usage metering (minutes of live class, storage, AI tokens, SMS), feature gating.
M50 White-label and Branding: custom domain, logo/colors/fonts, custom email sender, custom login page, hide platform branding on higher plans, embeddable booking widget and tutor-directory widget for external websites.
Every module must also have: settings page, permission set, demo seeder, notification templates, report(s), at least basic feature tests, and a public-page section (if it has any public value).

5. MODULE TOGGLE SYSTEM (CRITICAL)
Build the Module Center in the Business Admin panel:
Grid of all modules with description, status toggle, dependency info, and "what you get" preview.
Business presets (one-click): Solo Tutor, Tutoring Marketplace, Coaching Center, School/Institution, Language Academy, Exam-Prep Provider, Corporate Training, Full Platform. Presets just set toggles; everything remains editable.
Turning a module OFF: hides nav, routes return 404/redirect, API returns 403/404, scheduled jobs skip, widgets hidden, public pages removed from menu and sitemap, existing data is preserved (not deleted).
Turning a module ON: runs needed migrations/seeds, registers permissions, shows setup checklist.
Dependency graph enforced (e.g. Live Classroom requires Booking or Group Classes; Payouts requires Payments; Recordings requires Live Classroom).
Per-branch overrides and per-plan limits (SaaS mode).
A Setup Wizard on first login: choose business type → preset applied → branding → payments → first tutor/student → go live.
Write tests proving that disabled modules are truly inaccessible.

6. PUBLIC WEBSITE (SEVERAL PAGES SHOWING EVERY FEATURE)
Build a fast, SEO-optimized, responsive, multilingual public site (Blade + Livewire/Alpine + Tailwind) using universal slugs. Pages are shown only if their module is enabled:
Home: hero, search box (subject + level + date), featured tutors, popular subjects, how it works, live-class highlight, stats, testimonials, pricing teaser, CTA, trust badges.
Find a Tutor: search results with filters, map toggle, sort.
Tutor Profile: video intro, subjects, reviews, availability calendar with booking widget, packages, FAQ, similar tutors.
Subjects and Categories (and subject × city × level programmatic pages).
Courses and Programs: listing + detail pages.
Group Classes and Live Schedule.
How It Works (students, tutors, parents, institutions).
Features: one section/page per module, with screenshots/illustrations and short copy, driven from module manifests so it updates automatically.
Live Classroom and Whiteboard: tour page with interactive demo.
AI Study Assistant: feature page with live demo chat (rate-limited).
Pricing: for students (packages/subscriptions) and for businesses (SaaS plans), with comparison table.
Become a Tutor: benefits, earnings calculator, signup/application form.
For Parents: safety, monitoring, reports.
For Schools and Institutions: bulk management, enquiry form.
Free Trial / Book a Demo.
Blog, Resources and Webinars/Events.
Reviews and Success Stories.
About, Contact, Careers, Press.
FAQ and Help Center (knowledge base).
Certificate Verification page.
Legal: Terms, Privacy, Refund policy, Child-safety policy, Cookie policy.
Demo Login page: lists demo accounts per role with a one-click "login as" (only enabled when APP_DEMO=true).
Also: sitemap, robots, structured data, OG images, cookie consent, language/currency switcher, accessibility (WCAG AA), Core Web Vitals focus.

7. DEMO MODE AND DEMO USERS
Create DemoSeeder (idempotent, runnable with php artisan demo:install and php artisan demo:reset). Include realistic data across all enabled modules:
Demo accounts (password for all: password, display them on the Demo Login page and in README):
superadmin@demo.test: Super Admin
owner@demo.test: Business Owner/Admin
branch@demo.test: Branch Manager
tutor1@demo.test … tutor10@demo.test: Tutors (different subjects, tiers, countries, ratings)
student1@demo.test … student20@demo.test: Students (adult and minors)
guardian1@demo.test … guardian5@demo.test: Guardians linked to minors
support@demo.test: Support Agent
moderator@demo.test: Moderator
finance@demo.test: Finance Manager
content@demo.test: Content Manager
academic@demo.test: Academic Coordinator
institution@demo.test: Institution Admin (with 50 demo students)
affiliate@demo.test: Affiliate
Demo data must include: 2 businesses, 3 branches, 40+ subjects, 100+ topics, 30 tutors with availability, 100+ bookings in all statuses, 20 group classes, 8 courses, packages and subscriptions, paid/refunded/disputed payments (sandbox mode), wallet transactions, payouts, reviews, messages, assignments, quizzes with results, recordings (sample), certificates, attendance logs (including simulated machine punches via laravel-attendance-hub test mode), blog posts, FAQs, tickets, referrals, campaigns, and analytics history for the past 12 months so charts look alive.
Demo safety: payment gateways in sandbox, emails/SMS to log driver, AI calls limited or mocked, scheduled auto-reset (optional), banner "Demo mode".

8. DATABASE AND DOMAIN GUIDELINES
Migrations organized per module, reversible, with indexes and foreign keys; soft deletes where business-safe.
Money stored as integer minor units + currency code; ledger is double-entry and immutable.
All times stored in UTC; display in user timezone; booking logic must be timezone-correct (DST safe). Write tests for this.
Translatable fields via Spatie translatable; slugs via laravel-universal-slug.
Use enums, form requests, DTOs, actions/services, events/listeners; keep controllers/resources thin.
Use database transactions and locking for booking and payment flows (prevent double booking and double charge).
Idempotent webhooks, state machines for booking/payment/payout/dispute statuses.

9. KEY WORKFLOWS TO IMPLEMENT END-TO-END
Tutor onboarding: register → profile wizard → KYC upload → admin approval → publish → set availability → receive first booking.
Student booking: search → view tutor → pick slot (timezone-aware) → trial or paid → pay → confirmation + calendar invite → reminders → join live class → lesson ends → notes/homework → review → payout released to tutor after hold period.
Minor student flow: guardian creates child profile → approval rules → guardian pays → guardian sees schedule, recordings, reports.
Group class/course flow: publish → enroll → min-seat check → auto-cancel/refund if not met → run → certificate.
Subscription flow: subscribe → renewals → failed payment dunning → pause/cancel.
Cancellation/reschedule/no-show with policy engine and automatic fee/refund calculation.
Dispute flow: raise → evidence → moderator decision → refund/payout adjustment.
Institution flow: bulk import students → buy hours → assign tutors/batches → consolidated invoice.
Payout flow: earnings → hold → request/auto → approval → statement PDF.
Attendance machine flow: device registered → logs synced via attendance hub → mapped to users → daily report → guardian/HR alerts.

10. UI/UX STANDARDS
Modern, clean, trustworthy design; dark/light mode; RTL support; fully responsive; keyboard accessible.
Filament dashboards with role-specific widgets (use laravel-admin-panel where it fits).
Global search, quick actions, command palette, bulk actions, saved table filters, export on every table.
Empty states with guidance, onboarding checklists, inline help tooltips.
Consistent design tokens; business branding applied across panels and public site.

11. NOTIFICATIONS AND AUTOMATION (SCHEDULED JOBS)
Booking reminders (24h, 1h, 10m), unpaid booking expiry, package/subscription expiry warnings, dunning retries, payout schedule run, recording processing, retention cleanup, daily attendance sync, weekly progress digest for parents, tutor performance digest, abandoned booking recovery, catalog scraping jobs, sitemap refresh, FX rate refresh, backup runs, demo reset. Each job respects module toggles.

12. API
/api/v1 with Sanctum tokens: auth, profile, tutors search, availability, bookings, payments intents, classes, messages, notifications, assignments, quizzes, wallet, reviews, attendance. OpenAPI/Swagger docs page. Rate limits per key. Webhook events list in docs.

13. TESTING AND QUALITY
Pest/PHPUnit: feature tests per module, policy tests, booking concurrency test, payment webhook idempotency test, timezone/DST test, module on/off test, permission matrix test.
Static analysis (Larastan level 6+), Pint formatting, CI workflow file (GitHub Actions).
Seeders must run clean on fresh DB: php artisan migrate:fresh --seed then php artisan demo:install.
No N+1 queries on key pages (use a test or debugbar check).

14. README.md (MUST BE GENERATED, COMPLETE)
README.md must contain: product overview, every module with description and screenshots placeholders replaced by real feature bullet lists, role list, demo accounts table, architecture, installation (requirements, .env, migrate, seed, queue, Reverb, scheduler, storage link), module toggle guide and presets, how each mandatory package (drutogoti, laravel-admin-panel, laravel-ai-catalog, laravel-ai-hub, laravel-attendance-hub, laravel-unicode-pdf, laravel-universal-slug) is used, payment gateway setup, live-class driver setup (Jitsi/BBB/LiveKit/Zoom), email/SMS/WhatsApp setup, AI provider setup, attendance device setup, deployment guide (VPS with nginx/FastPanel, supervisor/Horizon, Redis, cron), backup, security checklist, API docs link, testing, contribution, license, changelog, and roadmap.
The public Features page content must match README (generate both from the same module manifests so they never drift).

15. SETTINGS (ADMIN-CONFIGURABLE, NO CODE EDITS)
General, branding, localization, currency and FX, payments, payout rules, commission rules, cancellation/refund policies, booking rules, live-class driver, recording policy, AI providers and limits, SMS/email/WhatsApp, attendance devices, SEO, legal pages, cookie/consent, security (2FA enforcement, password rules), integrations, API keys, storage, backups, module toggles.

16. EDGE CASES TO HANDLE
Tutor and student in different timezones and DST changes; double booking races; payment succeeded but webhook delayed; tutor no-show vs student no-show; internet drop mid-class (partial credit rules); minor protection and parent consent; currency conversion rounding; refund after payout; coupon stacking rules; subscription proration; deleting a user with financial history (anonymize, don't delete); tutor leaving platform with future bookings (reassign/refund); disabled module with existing data; tenant data isolation; RTL layouts; huge tutor catalogs (10k+) performance.

17. DELIVERABLES CHECKLIST
[ ] Full Laravel + Filament codebase, all modules, all panels
[ ] Module Center with presets and dependency handling
[ ] 7 mandatory packages integrated behind adapters
[ ] Public website with all pages above
[ ] Demo seeder and demo users for every role, demo login page
[ ] REST API + docs
[ ] Tests passing, static analysis clean
[ ] README.md complete
[ ] .env.example fully documented
[ ] Docker/Compose file and deployment guide (plus FastPanel/VPS notes)
[ ] CI config

18. CODING RULES
Follow Laravel and Filament official conventions; use the latest stable versions compatible with all required packages (verify before install).
No hardcoded strings: use translation files. No hardcoded money/currency/timezone.
Every action authorized; every external call wrapped with timeout, retry, and error logging.
Write clear docblocks on services and module manifests. Keep files focused and small.
Never commit secrets. Provide sensible defaults and sandbox keys only in .env.example comments.
If a library or API behaves differently from your assumption, read its docs/source and adapt. Do not guess.

19. HOW TO REPORT PROGRESS
After each phase, output: what was built, commands run, test results, known gaps (must be none by the final phase), and the next phase. If you hit an error, fix it before moving on.

20. EXECUTION PHASES
Phase 1: Foundation: install Laravel, Filament, mandatory packages, Redis/Horizon, tenancy/branches, roles/permissions, Module Manager and manifests, Core module, panels scaffolding, settings, localization, audit log, health page, setup wizard.
Phase 2: Marketplace Core: M02 to M08 (tutors, students, guardians, catalog, search, availability, booking), public home/search/profile pages, demo data for these.
Phase 3: Money: M23 to M28, plus wallet, commission, payouts, invoices with laravel-unicode-pdf, refunds/disputes.
Phase 4: Live Teaching: M09 to M18 (group classes, courses, live classroom, whiteboard, recordings, resources, assignments, quizzes, progress).
Phase 5: AI and Catalog: M19 to M22 via laravel-ai-hub and laravel-ai-catalog.
Phase 6: Growth and Communication: M29 to M36.
Phase 7: Operations and Institutions: M37 to M43 (including attendance hub integration), plus M40, M41, M42.
Phase 8: Platform: M44 to M50 (analytics, API, PWA, localization, backups, SaaS plans, white-label).
Phase 9: Public site completion, demo, QA: all remaining public pages, features page generated from manifests, demo installer/reset, performance pass with drutogoti, security review, full test run, README, Docker, CI.
Begin with Phase 1 now. Do not stop after planning: write the code, run it, and verify it works.
