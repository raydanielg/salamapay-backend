{{-- Include shadcn theme variables --}}
@include('tyro-dashboard::partials.shadcn-theme')

<style>
    :root {
        --background: #f9fafb;
        --sidebar: #ffffff;
        --sidebar-foreground: #111827;
        --sidebar-accent: #f3f4f6;
        --border: #e5e7eb;
        --primary: #3b82f6;
        --radius: 0.5rem;
    }

    body {
        font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, sans-serif;
        background-color: var(--background);
        color: #111827;
        margin: 0;
        padding: 0;
    }

    /* Dashboard Layout */
    .dashboard-layout {
        display: flex;
        min-height: 100vh;
    }

    /* Sidebar - Flowbite Style */
    .sidebar {
        width: 16rem;
        background-color: var(--sidebar);
        border-right: 1px solid var(--border);
        display: flex;
        flex-direction: column;
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 50;
        transition: transform 0.3s ease;
    }

    @media (max-width: 639px) {
        .sidebar {
            transform: translateX(-100%);
        }
        .sidebar.active {
            transform: translateX(0);
        }
    }

    .sidebar-logo-text {
        font-size: 1.125rem;
        font-weight: 700;
        color: #111827;
        margin-left: 0.75rem;
    }

    .brand-logo {
        display: block;
    }

    .brand-logo-dark {
        display: none;
    }

    .dark .brand-logo-light {
        display: none;
    }

    .dark .brand-logo-dark {
        display: block;
    }

    .sidebar-header {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1.25rem 1rem;
        border-bottom: 1px solid var(--border);
    }

    .sidebar-logo-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
    }

    .sidebar-menu-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .sidebar-item-link {
        display: flex;
        align-items: center;
        padding: 0.625rem 0.75rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
        border-radius: var(--radius);
        text-decoration: none;
        transition: all 0.2s;
    }

    .sidebar-item-link:hover {
        background-color: var(--sidebar-accent);
        color: #111827;
    }

    .sidebar-item-link.active {
        background-color: var(--sidebar-accent);
        color: #111827;
    }

    /* Icon sizing fix */
    .sidebar-item-link svg, 
    .sidebar-dropdown-btn svg:first-child {
        width: 1.25rem !important;
        height: 1.25rem !important;
        flex-shrink: 0;
        color: #9ca3af;
        transition: color 0.2s;
    }

    .sidebar-dropdown-btn svg:last-child {
        width: 1.25rem !important;
        height: 1.25rem !important;
        flex-shrink: 0;
        margin-left: auto;
        color: #9ca3af;
        opacity: 0.8;
    }

    .sidebar-item-link:hover svg,
    .sidebar-item-link.active svg {
        color: #111827;
    }

    .sidebar-dropdown-btn {
        display: flex;
        align-items: center;
        width: 100%;
        padding: 0.625rem 0.75rem;
        gap: 0.75rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
        border-radius: var(--radius);
        background: transparent;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }

    .sidebar-dropdown-btn.open {
        background-color: var(--sidebar-accent);
        color: #111827;
    }

    .sidebar-dropdown-btn .sidebar-chevron {
        transition: transform 0.2s ease;
        transform: rotate(0deg);
        transform-origin: center;
    }

    .sidebar-dropdown-btn.open .sidebar-chevron {
        transform: rotate(180deg);
    }

    .sidebar-user .sidebar-dropdown-btn.open .sidebar-chevron {
        transform: rotate(90deg);
    }

    .sidebar-user-group {
        padding: 0.5rem;
    }

    .sidebar-user-group-label {
        height: 2rem;
        display: flex;
        align-items: center;
        padding: 0 0.5rem;
        font-size: 0.75rem;
        font-weight: 600;
        color: rgba(17, 24, 39, 0.7);
    }

    .sidebar-user .sidebar-dropdown-list {
        padding: 0.25rem 0 0.25rem 2.25rem;
        margin: 0;
        position: relative;
    }

    .sidebar-user .sidebar-dropdown-list::before {
        content: '';
        position: absolute;
        left: 1.375rem;
        top: 0.25rem;
        bottom: 0.25rem;
        width: 1px;
        background: #e5e7eb;
    }

    .sidebar-pill {
        margin-left: auto;
        padding: 0.125rem 0.5rem;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 9999px;
        background-color: rgba(5, 150, 105, 0.12);
        color: #059669;
    }

    .sidebar-badge {
        margin-left: auto;
        padding: 0.125rem 0.5rem;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 9999px;
        background-color: rgba(239, 68, 68, 0.12);
        color: #ef4444;
    }

    .sp-badge {
        margin-left: auto;
        padding: 0.125rem 0.5rem;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 9999px;
        background-color: rgba(239, 68, 68, 0.12);
        color: #ef4444;
    }

    .btn-primary {
        background-color: #000000 !important;
        color: #ffffff !important;
        border: 1px solid #000000 !important;
    }
    .btn-primary:hover {
        background-color: #1a1a1a !important;
        border-color: #1a1a1a !important;
    }
    .btn-outline {
        background-color: #f3f4f6 !important;
        color: #374151 !important;
        border: 1px solid #e5e7eb !important;
    }
    .btn-outline:hover {
        background-color: #e5e7eb !important;
    }
    .sp-badge-v {
        padding: 0.125rem 0.5rem;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 9999px;
        background-color: #dcfce7 !important;
        color: #166534 !important;
        display: inline-flex;
        align-items: center;
    }
    .sp-badge-nv {
        padding: 0.125rem 0.5rem;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 9999px;
        background-color: #fee2e2 !important;
        color: #991b1b !important;
        display: inline-flex;
        align-items: center;
    }

    .sidebar-user-bottom {
        margin-top: auto;
        padding: 0.5rem;
    }

    .sidebar-section-label {
        padding: 0.75rem 0.75rem 0.25rem;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: rgba(107, 114, 128, 0.9);
        user-select: none;
    }

    .sidebar-dropdown-item.active {
        background-color: var(--sidebar-accent);
        color: #111827;
    }

    .sidebar.sidebar-admin {
        background: #ffffff;
        border-right: 1px solid #e5e7eb;
    }

    .sidebar.sidebar-admin .sidebar-header {
        border-bottom: 1px solid #e5e7eb;
    }

    .sidebar.sidebar-admin .sidebar-logo-text {
        color: #111827;
    }

    .sidebar.sidebar-admin .sidebar-item-link,
    .sidebar.sidebar-admin .sidebar-dropdown-btn {
        color: #111827;
    }

    .sidebar.sidebar-admin .sidebar-item-link:hover,
    .sidebar.sidebar-admin .sidebar-dropdown-btn:hover {
        background: rgba(17, 24, 39, 0.05);
        color: #111827;
    }

    .sidebar.sidebar-admin .sidebar-item-link.active {
        background: rgba(5, 150, 105, 0.10);
        border: 1px solid rgba(5, 150, 105, 0.18);
        color: #064e3b;
    }

    .sidebar.sidebar-admin .sidebar-dropdown-btn.open {
        background: rgba(5, 150, 105, 0.08);
        color: #064e3b;
    }

    .sidebar.sidebar-admin .sidebar-item-link svg,
    .sidebar.sidebar-admin .sidebar-dropdown-btn svg:first-child,
    .sidebar.sidebar-admin .sidebar-dropdown-btn .sidebar-chevron {
        color: rgba(17, 24, 39, 0.65);
    }

    .sidebar.sidebar-admin .sidebar-item-link:hover svg,
    .sidebar.sidebar-admin .sidebar-item-link.active svg,
    .sidebar.sidebar-admin .sidebar-dropdown-btn:hover svg:first-child,
    .sidebar.sidebar-admin .sidebar-dropdown-btn.open svg:first-child {
        color: #064e3b;
    }

    .sidebar.sidebar-admin .sidebar-section-label {
        color: rgba(17, 24, 39, 0.55);
    }

    .sidebar.sidebar-admin .sidebar-dropdown-list {
        padding-left: 1.75rem;
    }

    .sidebar.sidebar-admin .sidebar-dropdown-item {
        color: rgba(17, 24, 39, 0.75);
    }

    .sidebar.sidebar-admin .sidebar-dropdown-item:hover {
        background: rgba(17, 24, 39, 0.05);
        color: #111827;
    }

    .sidebar.sidebar-admin .sidebar-dropdown-item.active {
        background: rgba(5, 150, 105, 0.10);
        color: #064e3b;
    }

    .sidebar.sidebar-admin .sidebar-footer-actions {
        border-top: 1px solid #e5e7eb;
        background: #ffffff;
    }

    .sidebar.sidebar-admin .sidebar-footer-btn {
        color: rgba(17, 24, 39, 0.65);
    }

    .sidebar.sidebar-admin .sidebar-footer-btn:hover {
        background: rgba(17, 24, 39, 0.05);
        color: #111827;
    }

    .sidebar.sidebar-admin .sidebar-dropdown-btn.open .sidebar-chevron {
        transform: rotate(90deg);
    }

    .sidebar.sidebar-admin .sidebar-item-link svg,
    .sidebar.sidebar-admin .sidebar-dropdown-btn svg:first-child,
    .sidebar.sidebar-admin .sidebar-dropdown-btn .sidebar-chevron {
        width: 1rem !important;
        height: 1rem !important;
    }

    .sidebar.sidebar-user {
        background: #f3f4f6;
        border-right: 1px solid #e5e7eb;
    }

    .sidebar.sidebar-user .sidebar-header {
        border-bottom: 0;
        padding: 1rem;
    }

    .sidebar.sidebar-user .sidebar-nav-container {
        display: flex;
        flex-direction: column;
        min-height: 0;
        flex: 1;
        overflow: auto;
    }

    .sidebar.sidebar-user .sidebar-item-link,
    .sidebar.sidebar-user .sidebar-dropdown-btn {
        height: 2rem;
        padding: 0.5rem;
        border-radius: 0.5rem;
        font-size: 0.9375rem;
        font-weight: 500;
        color: #111827;
    }

    .sidebar.sidebar-user .sidebar-item-link.active {
        background-color: rgba(17, 24, 39, 0.06);
    }

    .sidebar.sidebar-user .sidebar-item-link:hover,
    .sidebar.sidebar-user .sidebar-dropdown-btn:hover {
        background-color: rgba(17, 24, 39, 0.05);
    }

    .sidebar.sidebar-user .sidebar-dropdown-btn.open {
        background-color: rgba(17, 24, 39, 0.03);
    }

    .sidebar.sidebar-user .sidebar-item-link svg,
    .sidebar.sidebar-user .sidebar-dropdown-btn svg:first-child,
    .sidebar.sidebar-user .sidebar-dropdown-btn .sidebar-chevron {
        width: 1rem !important;
        height: 1rem !important;
        color: #111827;
    }

    .sidebar.sidebar-user .sidebar-user-group {
        padding: 0.5rem;
    }

    .sidebar.sidebar-user .sidebar-user-bottom {
        padding: 0.5rem;
        padding-bottom: 1rem;
    }

    .sidebar.sidebar-user .sidebar-badge {
        background-color: rgba(239, 68, 68, 0.12);
        color: #ef4444;
    }

    .sidebar-dropdown-btn:hover {
        background-color: var(--sidebar-accent);
        color: #111827;
    }

    .sidebar-dropdown-list {
        list-style: none;
        display: none;
        padding: 0.25rem 0 0.25rem 1rem;
        margin: 0;
    }

    .sidebar-dropdown-list.show {
        display: flex;
        flex-direction: column;
        gap: 0.125rem;
    }

    .sidebar-dropdown-item {
        display: flex;
        align-items: center;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        color: #4b5563;
        border-radius: var(--radius);
        text-decoration: none;
        transition: all 0.2s;
    }

    .sidebar-dropdown-item:hover {
        background-color: var(--sidebar-accent);
        color: #111827;
    }

    .sidebar-footer-actions {
        padding: 1rem;
        border-top: 1px solid var(--border);
        display: flex;
        justify-content: space-around;
        background: #fff;
    }

    .sidebar-footer-btn {
        color: #6b7280;
        padding: 0.5rem;
        border-radius: var(--radius);
        transition: all 0.2s;
    }

    .sidebar.sidebar-user .sidebar-footer-btn:hover {
        background-color: var(--sidebar-accent);
        color: #111827;
    }

    .admin-menu-explorer {
        margin-top: 1.25rem;
        background: #ffffff;
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 1rem;
    }

    .admin-menu-explorer-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 0.75rem;
        margin-bottom: 0.75rem;
    }

    .admin-menu-explorer-title {
        font-weight: 800;
        color: #111827;
        font-size: 1.05rem;
        line-height: 1.2;
    }

    .admin-menu-explorer-subtitle {
        color: #6b7280;
        font-size: 0.9rem;
        margin-top: 0.125rem;
    }

    .admin-menu-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 0.75rem;
    }

    @media (max-width: 1200px) {
        .admin-menu-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (max-width: 900px) {
        .admin-menu-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 520px) {
        .admin-menu-grid {
            grid-template-columns: 1fr;
        }
    }

    .admin-menu-card {
        display: flex;
        gap: 0.75rem;
        align-items: flex-start;
        padding: 0.85rem;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        background: #ffffff;
        text-decoration: none;
        transition: transform 0.15s ease, box-shadow 0.15s ease, border-color 0.15s ease;
        color: inherit;
        min-height: 86px;
    }

    .admin-menu-card:hover {
        transform: translateY(-1px);
        border-color: rgba(5, 150, 105, 0.25);
        box-shadow: 0 10px 25px rgba(17, 24, 39, 0.08);
    }

    .admin-menu-card-icon {
        width: 2.25rem;
        height: 2.25rem;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(5, 150, 105, 0.10);
        border: 1px solid rgba(5, 150, 105, 0.16);
        flex: 0 0 auto;
        color: #059669;
    }

    .admin-menu-card-icon svg {
        width: 1.15rem;
        height: 1.15rem;
    }

    .admin-menu-card-title {
        font-weight: 800;
        color: #111827;
        font-size: 0.95rem;
        line-height: 1.2;
    }

    .admin-menu-card-desc {
        margin-top: 0.2rem;
        color: #6b7280;
        font-size: 0.85rem;
        line-height: 1.3;
    }

    .admin-menu-card.admin-menu-card-small {
        align-items: center;
        min-height: 70px;
    }

    .admin-menu-card.admin-menu-card-small .admin-menu-card-desc {
        margin-top: 0.15rem;
    }

    /* Main Content Area */
    .main-content {
        flex: 1;
        margin-left: 16rem;
        min-height: 100vh;
        background-color: var(--background);
        transition: margin-left 0.3s ease;
    }

    @media (max-width: 639px) {
        .main-content {
            margin-left: 0;
        }
    }

    .page-content {
        padding: 1.5rem;
    }

    .sp-welcome {
        display: grid;
        grid-template-columns: 1.1fr 0.9fr;
        gap: 1.25rem;
        margin-bottom: 1.5rem;
        align-items: stretch;
    }

    .sp-welcome-left {
        background: #ffffff;
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 1.25rem;
    }

    .sp-welcome-kicker {
        font-size: 0.8125rem;
        font-weight: 600;
        color: #059669;
        margin-bottom: 0.375rem;
    }

    .sp-welcome-title {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 800;
        color: #111827;
        line-height: 1.2;
    }

    .sp-welcome-desc {
        margin: 0.5rem 0 0;
        color: #4b5563;
        font-size: 0.9375rem;
        line-height: 1.5;
    }

    .sp-welcome-actions {
        display: flex;
        gap: 0.75rem;
        margin-top: 1rem;
        flex-wrap: wrap;
    }

    .sp-welcome .btn.btn-primary {
        background: #059669;
        border-color: #059669;
    }

    .sp-welcome .btn.btn-primary:hover {
        background: #047857;
        border-color: #047857;
    }

    .sp-card {
        border-radius: 18px;
        padding: 1rem;
        color: #ffffff;
        border: 1px solid rgba(255, 255, 255, 0.22);
        background:
          radial-gradient(900px circle at 10% 10%, rgba(255, 255, 255, 0.22), transparent 38%),
          radial-gradient(900px circle at 90% 15%, rgba(16, 185, 129, 0.35), transparent 40%),
          linear-gradient(135deg, #064e3b 0%, #059669 45%, #111827 100%);
        box-shadow: 0 18px 40px rgba(17, 24, 39, 0.22);
        position: relative;
        overflow: hidden;
        min-height: 220px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .sp-card::after {
        content: '';
        position: absolute;
        inset: -40px;
        background: radial-gradient(600px circle at 20% 20%, rgba(255, 255, 255, 0.14), transparent 50%);
        pointer-events: none;
    }

    .sp-card-top,
    .sp-card-middle,
    .sp-card-bottom {
        position: relative;
        z-index: 1;
    }

    .sp-card-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
    }

    .sp-card-brand {
        display: flex;
        align-items: center;
        gap: 0.625rem;
        min-width: 0;
    }

    .sp-card-logo {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.14);
        color: #ecfdf5;
        flex-shrink: 0;
    }

    .sp-card-logo svg {
        width: 22px;
        height: 22px;
        display: block;
    }

    .sp-card-name {
        font-weight: 800;
        letter-spacing: 0.2px;
        line-height: 1.1;
    }

    .sp-card-sub {
        font-size: 0.75rem;
        opacity: 0.9;
    }

    .sp-card-visa {
        font-weight: 900;
        letter-spacing: 2px;
        font-size: 0.875rem;
        padding: 0.375rem 0.6rem;
        border-radius: 9999px;
        background: rgba(255, 255, 255, 0.14);
        border: 1px solid rgba(255, 255, 255, 0.18);
        flex-shrink: 0;
    }

    .sp-card-number {
        margin-top: 1rem;
        font-size: 1.05rem;
        font-weight: 700;
        letter-spacing: 2px;
    }

    .sp-card-row {
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 0.75rem;
        margin-top: 0.75rem;
    }

    .sp-card-label {
        font-size: 0.6875rem;
        letter-spacing: 1px;
        opacity: 0.85;
    }

    .sp-card-value {
        font-weight: 700;
        font-size: 0.875rem;
        margin-top: 0.25rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 220px;
    }

    .sp-card-bottom {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 0.75rem;
        margin-top: 1rem;
    }

    .sp-card-chip {
        width: 44px;
        height: 34px;
        border-radius: 10px;
        background: linear-gradient(135deg, rgba(253, 230, 138, 0.95), rgba(245, 158, 11, 0.6));
        border: 1px solid rgba(255, 255, 255, 0.22);
        box-shadow: inset 0 0 0 1px rgba(17, 24, 39, 0.15);
    }

    .sp-card-qr {
        width: 64px;
        height: 64px;
        border-radius: 12px;
        overflow: hidden;
        flex-shrink: 0;
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.18);
    }

    .sp-card-qr svg {
        width: 100%;
        height: 100%;
        display: block;
    }

    @media (max-width: 1024px) {
        .sp-welcome {
            grid-template-columns: 1fr;
        }
        .sp-card {
            min-height: 200px;
        }
    }

    .sp-profile {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .sp-profile-hero {
        background: var(--sidebar);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 1.25rem;
    }

    .sp-profile-hero-inner {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .sp-profile-title {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 800;
        color: #111827;
        letter-spacing: -0.01em;
    }

    .sp-profile-subtitle {
        margin: 0;
        color: var(--muted-foreground);
        font-size: 0.95rem;
        line-height: 1.5;
        max-width: 52ch;
    }

    .sp-profile-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        align-items: start;
    }

    @media (max-width: 1024px) {
        .sp-profile-grid {
            grid-template-columns: 1fr;
        }
    }

    .sp-field-group {
        display: flex;
        flex-direction: column;
        gap: 0;
    }

    .sp-field-row {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 1rem;
        padding: 1rem 1.25rem;
        border-top: 1px solid var(--border);
    }

    .sp-field-row:first-child {
        border-top: none;
    }

    .sp-field-left {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        flex: 1;
        min-width: 0;
    }

    .sp-field-icon {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
        color: var(--muted-foreground);
        margin-top: 2px;
    }

    .sp-field-title {
        font-size: 0.9375rem;
        font-weight: 600;
        color: var(--foreground);
        line-height: 1.2;
    }

    .sp-field-desc {
        font-size: 0.875rem;
        color: var(--muted-foreground);
        margin-top: 0.25rem;
        line-height: 1.35;
    }

    .sp-field-right {
        width: 16rem;
        flex-shrink: 0;
    }

    .sp-field-right .form-input {
        width: 100%;
    }

    .sp-photo-row {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .sp-account-id-box {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--muted);
        padding: 0.25rem 0.5rem;
        border-radius: 6px;
        font-family: monospace;
        font-size: 0.8125rem;
        width: fit-content;
    }

    .copy-btn {
        padding: 0.25rem;
        border-radius: 4px;
        transition: all 0.2s;
        cursor: pointer;
        color: var(--muted-foreground);
    }

    .copy-btn:hover {
        background: rgba(0,0,0,0.05);
        color: var(--foreground);
    }

    @media (max-width: 768px) {
        .sp-field-row {
            flex-direction: column;
            align-items: stretch;
        }

        .sp-field-right {
            width: 100%;
        }
    }

    /* Mobile Toggle */
    .mobile-sidebar-toggle {
        position: fixed;
        top: 0.75rem;
        left: 0.75rem;
        z-index: 60;
        display: none;
        padding: 0.5rem;
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        cursor: pointer;
    }

    @media (max-width: 639px) {
        .mobile-sidebar-toggle {
            display: none;
        }

        .topbar {
            padding: 0 0.75rem;
            height: 56px;
        }

        .breadcrumb {
            font-size: 0.875rem;
        }

        .page-content {
            padding: 1rem;
        }
    }

    .badge-pill {
        margin-left: auto;
        padding: 0.125rem 0.5rem;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 9999px;
        background-color: #dbeafe;
        color: #1e40af;
    }

    /* Top Bar - shadcn style */
    .topbar {
        background-color: #ffffff !important;
        border-bottom: 1px solid #e5e7eb !important;
        padding: 0 1.5rem;
        height: 64px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: sticky;
        top: 0;
        z-index: 30;
    }

    .topbar-left {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .mobile-menu-btn {
        display: none;
        padding: 0.5rem;
        border: none;
        background: transparent;
        color: var(--foreground);
        cursor: pointer;
        border-radius: 6px;
    }

    .mobile-menu-btn:hover {
        background-color: var(--muted);
    }

    .mobile-menu-btn svg {
        width: 20px;
        height: 20px;
    }

    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9375rem;
        color: var(--muted-foreground);
    }

    .breadcrumb a {
        color: var(--muted-foreground);
        text-decoration: none;
        transition: color 0.15s ease;
    }

    .breadcrumb a:hover {
        color: var(--foreground);
    }

    .breadcrumb-separator {
        color: var(--muted-foreground);
        opacity: 0.5;
    }

    .topbar-right {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .topbar-icon-btn {
        background-color: transparent !important;
        border: 1px solid #e5e7eb !important;
        color: #374151 !important;
        padding: 0.5rem;
        border-radius: 0.5rem;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
    }

    .topbar-icon-btn:hover {
        background-color: #f9fafb !important;
        border-color: #d1d5db !important;
        color: #111827 !important;
    }

    /* Welcome Card Styles */
    .welcome-card {
        background: linear-gradient(135deg, #064e3b 0%, #065f46 50%, #059669 100%) !important;
        border-radius: 1rem !important;
        padding: 2.5rem !important;
        color: #ffffff !important;
        position: relative;
        overflow: hidden;
        border: none !important;
    }

    .welcome-card::before {
        content: "";
        position: absolute;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        opacity: 0.4;
        pointer-events: none;
    }

    .welcome-card::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .welcome-hello {
        color: #fbbf24 !important;
        font-size: 0.875rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.75rem;
    }

    .welcome-title {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        color: #ffffff !important;
    }

    .welcome-desc {
        font-size: 0.9375rem;
        color: rgba(255, 255, 255, 0.8) !important;
        margin-bottom: 1.5rem;
        max-width: 600px;
    }

    .welcome-desc b {
        color: #fbbf24 !important;
    }

    .welcome-member-id {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(0, 0, 0, 0.3) !important;
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-size: 0.8125rem;
        font-family: monospace;
        color: rgba(255, 255, 255, 0.9) !important;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .welcome-member-id span {
        color: #fbbf24 !important;
        font-weight: 700;
    }

    /* Simple Calendar Styles */
    .calendar-card {
        background: #f3f4f6 !important;
        border-radius: 1rem !important;
        padding: 1.5rem !important;
        border: 1px solid #e5e7eb !important;
    }

    .dark .calendar-card {
        background: #1a1a1a !important;
        border-color: #333333 !important;
    }

    .calendar-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: #111827;
    }

    .dark .calendar-header {
        color: #ffffff;
    }

    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 0.5rem;
        text-align: center;
    }

    .calendar-day-label {
        font-size: 0.75rem;
        color: #9ca3af;
        font-weight: 600;
        padding-bottom: 0.5rem;
    }

    .calendar-day {
        font-size: 0.8125rem;
        padding: 0.5rem;
        border-radius: 0.5rem;
        color: #4b5563;
    }

    .dark .calendar-day {
        color: #9ca3af;
    }

    .calendar-day.today {
        background: #059669 !important;
        color: #ffffff !important;
        font-weight: 700;
    }

    .dashboard-grid-bottom {
        display: block;
        margin-top: 1.5rem;
        margin-bottom: 3rem;
    }

    /* SalamaPay Virtual Card Styles v2 */
    .sp-virtual-card {
        width: 100%;
        max-width: 410px !important;
        min-height: 220px;
        height: 220px;
        border-radius: 22px;
        padding: 25px 30px;
        color: white;
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05)), linear-gradient(135deg, #0f3d2e, #146c43, #1aa179) !important;
        box-shadow: 0 18px 32px rgba(0, 0, 0, 0.22);
        transition: 0.4s ease;
        border: 1px solid rgba(255, 255, 255, 0.2) !important;
        display: flex;
        flex-direction: column;
    }

    .sp-virtual-card:hover {
        transform: scale(1.03);
    }

    /* CUT DIAGONAL LINE */
    .sp-virtual-card::before {
        content: "";
        position: absolute;
        width: 600px;
        height: 300px;
        background: rgba(255, 255, 255, 0.06);
        transform: rotate(-20deg);
        top: -120px;
        left: -150px;
        pointer-events: none;
    }

    /* BUBBLES */
    .sp-virtual-card::after {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        background: rgba(255, 255, 255, 0.07);
        border-radius: 50%;
        bottom: -60px;
        right: -60px;
        box-shadow:
            -220px -120px 0 40px rgba(255, 255, 255, 0.04),
            -120px 40px 0 25px rgba(255, 255, 255, 0.05);
        pointer-events: none;
    }

    .sp-card-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        z-index: 1;
    }

    .sp-card-brand {
        font-size: 22px;
        font-weight: 600;
        letter-spacing: 1px;
    }

    .sp-card-logo-box {
        width: 50px;
        height: 40px;
        border-radius: 8px;
        border: 2px solid rgba(255, 255, 255, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: bold;
        opacity: 0.8;
    }

    .sp-balance-section {
        margin-top: 25px;
        position: relative;
        z-index: 1;
    }

    .sp-balance-title {
        font-size: 12px;
        opacity: 0.8;
    }

    .sp-balance-amount {
        font-size: 28px;
        font-weight: 600;
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .sp-balance-eye {
        cursor: pointer;
        font-size: 1.25rem;
        opacity: 1 !important;
        color: rgba(255, 255, 255, 0.9) !important;
        transition: transform 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        background: transparent;
        border: none;
        padding: 0;
        line-height: 1;
    }

    .sp-balance-eye:hover {
        transform: scale(1.1);
        color: #ffffff !important;
    }

    .sp-card-number {
        margin-top: 30px;
        font-size: 20px;
        letter-spacing: 4px;
        font-family: monospace;
        position: relative;
        z-index: 1;
    }

    .sp-card-footer {
        margin-top: 22px;
        display: flex;
        justify-content: space-between;
        position: relative;
        z-index: 1;
    }

    .sp-footer-label {
        font-size: 10px;
        opacity: 0.7;
        display: block;
        text-transform: uppercase;
    }

    .sp-footer-value {
        margin: 3px 0 0 0;
        font-size: 14px;
        font-weight: 600;
    }

    .sp-card-note {
        position: absolute;
        bottom: 10px;
        left: 0;
        right: 0;
        text-align: center;
        font-size: 11px;
        opacity: 0.75;
        z-index: 1;
    }

    @media (max-width: 640px) {
        .sp-virtual-card {
            max-width: 100%;
            min-height: 220px;
            padding: 20px;
            height: auto;
        }
        .sp-card-brand {
            font-size: 1.25rem;
        }
        .sp-card-number {
            font-size: 1.1rem;
            letter-spacing: 2px;
            margin-top: 25px;
        }
        .sp-balance-amount {
            font-size: 1.5rem;
        }
        .sp-footer-value {
            font-size: 0.8125rem;
        }
    }

    .dashboard-content-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(390px, 1fr));
        gap: 1.5rem;
        margin-top: 1.5rem;
    }

    

    .user-avatar-btn {
        background-color: transparent !important;
        border: 1px solid #e5e7eb !important;
        padding: 3px;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .user-avatar-btn:hover {
        background-color: #f9fafb !important;
        border-color: #d1d5db !important;
    }

    .user-avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #000000 !important;
        color: #ffffff !important;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 700;
        overflow: hidden;
    }

    .user-dropdown-arrow {
        width: 14px;
        height: 14px;
        color: var(--muted-foreground);
    }

    /* Dark Mode Global Styles */
    .dark .topbar {
        background-color: #1a1a1a !important;
        border-bottom: 1px solid #333333 !important;
    }

    .dark .topbar-icon-btn {
        border-color: #333333 !important;
        color: #d1d5db !important;
    }

    .dark .topbar-icon-btn:hover {
        background-color: #262626 !important;
        color: #ffffff !important;
    }

    .dark .user-avatar-btn {
        border-color: #333333 !important;
    }

    .dark .user-dropdown-menu {
        background-color: #1a1a1a !important;
        border-color: #333333 !important;
    }

    .dark .dropdown-header {
        border-bottom-color: #333333 !important;
    }

    .dark .dropdown-header span:first-child {
        color: #ffffff !important;
    }

    .dark .dropdown-header span:last-child {
        color: #9ca3af !important;
    }

    .dark .dropdown-item {
        color: #d1d5db !important;
    }

    .dark .dropdown-item:hover {
        background-color: #262626 !important;
        color: #ffffff !important;
    }

    .dark .dropdown-divider, .dark .border-top {
        border-top-color: #333333 !important;
    }

    .dark .card {
        background-color: #1a1a1a !important;
        border-color: #333333 !important;
    }

    .dark .sp-field-row {
        border-top-color: #333333 !important;
    }

    .dark .sp-field-title {
        color: #ffffff !important;
    }

    .dark .sp-field-desc {
        color: #9ca3af !important;
    }

    .dark .form-input {
        background-color: #262626 !important;
        border-color: #333333 !important;
        color: #ffffff !important;
    }

    .dark .form-input:disabled {
        background-color: #1a1a1a !important;
        color: #6b7280 !important;
    }

    .dark .sp-account-id-box {
        background-color: #262626 !important;
        color: #ffffff !important;
    }

    .dark .breadcrumb {
        color: #ffffff !important;
    }

    .dark body {
        background-color: #0a0a0a !important;
        color: #ededed !important;
    }

    .user-dropdown-menu {
        position: absolute;
        top: 100%;
        right: 0;
        margin-top: 0.5rem;
        width: 240px;
        background-color: #ffffff !important;
        border: 1px solid #e5e7eb !important;
        border-radius: 0.75rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        display: none;
        flex-direction: column;
        z-index: 50;
        overflow: hidden;
    }

    .user-dropdown.active .user-dropdown-menu {
        display: flex !important;
    }

    .dropdown-item:hover {
        background-color: #f3f4f6 !important;
        color: #111827 !important;
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 0.625rem;
        color: var(--muted-foreground);
        text-decoration: none;
        font-size: 0.8125rem;
        border-radius: 4px;
        transition: all 0.15s ease;
    }

    .dropdown-item:hover {
        background-color: var(--muted);
        color: var(--foreground);
    }

    .dropdown-item svg {
        width: 14px;
        height: 14px;
    }

    .dropdown-divider {
        height: 1px;
        background-color: var(--border);
        margin: 0.25rem 0;
    }

    .dropdown-item-danger {
        color: var(--destructive);
    }

    .dropdown-item-danger:hover {
        background-color: color-mix(in srgb, var(--destructive), transparent 90%);
        color: var(--destructive);
    }

    /* Page Content */
    .page-content {
        padding: 2rem;
        flex: 1;
        background-color: var(--background);
        /* max-width: 1200px; */
    }

    /* Page Header */
    .page-header {
        margin-bottom: 2rem;
    }

    .page-header-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .page-title {
        font-size: 1.875rem;
        font-weight: 600;
        color: var(--foreground);
        margin: 0;
    }

    .page-description {
        margin-top: 0.375rem;
        font-size: 0.9375rem;
        color: var(--muted-foreground);
    }

    .admin-welcome-actions {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    /* Cards - shadcn style */
    .card {
        background: var(--background);
        border: 1px solid var(--border);
        border-radius: 8px;
        box-shadow: var(--card-shadow);
    }

    .card-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .card-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--foreground);
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-footer {
        padding: 1.25rem 1.5rem;
        border-top: 1px solid var(--border);
        background-color: var(--muted);
        border-radius: 0 0 8px 8px;
    }

    /* Stats Cards - shadcn style */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .admin-stats-grid {
        gap: 0.9rem;
        margin-top: 1rem;
    }

    .admin-stats-grid .stat-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 1.05rem;
        border: 1px solid rgba(17, 24, 39, 0.08);
        box-shadow: 0 10px 25px rgba(17, 24, 39, 0.05);
        transform: translateY(0);
    }

    .admin-stats-grid .stat-card:hover {
        box-shadow: 0 18px 40px rgba(17, 24, 39, 0.10);
        transform: translateY(-1px);
        border-color: rgba(5, 150, 105, 0.18);
    }

    .admin-stats-grid .stat-icon {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(5, 150, 105, 0.18);
        background: rgba(5, 150, 105, 0.10);
        color: #059669;
    }

    .admin-stats-grid .stat-icon svg {
        width: 1.25rem;
        height: 1.25rem;
    }

    .admin-stats-grid .stat-label {
        color: rgba(17, 24, 39, 0.70);
        font-weight: 700;
    }

    .admin-stats-grid .stat-value {
        margin-top: 0.25rem;
        font-size: 1.6rem;
        font-weight: 900;
        letter-spacing: -0.02em;
    }

    .stat-card {
        background: var(--background);
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 1.5rem;
        transition: all 0.15s ease;
    }

    .stat-card:hover {
        box-shadow: var(--card-shadow-hover);
    }

    .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }

    .stat-icon svg {
        width: 22px;
        height: 22px;
    }

    .stat-icon-primary {
        background-color: var(--muted);
        color: var(--foreground);
    }

    .stat-icon-success {
        background-color: color-mix(in srgb, var(--success), transparent 90%);
        color: var(--success);
    }

    .stat-icon-warning {
        background-color: color-mix(in srgb, var(--warning), transparent 90%);
        color: var(--warning);
    }

    .stat-icon-danger {
        background-color: color-mix(in srgb, var(--destructive), transparent 90%);
        color: var(--destructive);
    }

    .stat-icon-info {
        background-color: color-mix(in srgb, var(--info), transparent 90%);
        color: var(--info);
    }

    .stat-label {
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--muted-foreground);
        margin-bottom: 0.375rem;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--foreground);
        line-height: 1;
        letter-spacing: -0.025em;
    }

    .stat-change {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        font-size: 0.6875rem;
        font-weight: 500;
        margin-top: 0.5rem;
    }

    .stat-change-up {
        color: var(--success);
    }

    .stat-change-down {
        color: var(--destructive);
    }

    /* Tables - shadcn style */
    .table-container {
        overflow-x: auto;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        padding: 1rem 1.25rem;
        text-align: left;
        border-bottom: 1px solid var(--border);
    }

    .table th {
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--muted-foreground);
        background-color: var(--muted);
    }

    .table td {
        font-size: 0.9375rem;
        color: var(--foreground);
    }

    .table tbody tr:hover {
        background-color: var(--muted);
    }

    .table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Buttons - shadcn style */
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.625rem 1rem;
        font-size: 0.9375rem;
        font-weight: 500;
        font-family: inherit;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.15s ease;
        text-decoration: none;
        white-space: nowrap;
        line-height: 1.25;
    }

    .btn svg {
        width: 18px;
        height: 18px;
    }

    .btn-sm {
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
    }

    .btn-lg {
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
    }

    .btn-primary {
        background-color: var(--primary);
        color: var(--primary-foreground);
    }

    .btn-primary:hover {
        background-color: color-mix(in srgb, var(--primary), black 10%);
    }

    .btn-default {
        background-color: var(--primary);
        color: var(--primary-foreground);
    }

    .btn-default:hover {
        opacity: 0.9;
    }

    .btn-destructive {
        background-color: var(--destructive);
        color: var(--destructive-foreground);
    }

    .btn-destructive:hover {
        opacity: 0.9;
    }

    .btn-secondary {
        background-color: var(--secondary);
        color: var(--secondary-foreground);
    }

    .btn-secondary:hover {
        opacity: 0.8;
    }

    .btn-outline-btn {
        background-color: var(--background);
        border: 1px solid var(--input);
        color: var(--foreground);
    }

    .btn-outline-btn:hover {
        background-color: var(--accent);
        color: var(--accent-foreground);
    }

    .btn-ghost-btn {
        background-color: transparent;
        color: var(--foreground);
    }

    .btn-ghost-btn:hover {
        background-color: var(--accent);
        color: var(--accent-foreground);
    }

    .btn-link-btn {
        background-color: transparent;
        color: var(--primary);
        text-decoration: underline;
        text-underline-offset: 4px;
    }

    .btn-link-btn:hover {
        text-decoration: underline;
    }

    .btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    /* Form Elements - shadcn style */
    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-label {
        display: block;
        font-size: 0.9375rem;
        font-weight: 500;
        color: var(--foreground);
        margin-bottom: 0.5rem;
    }

    .form-label-optional {
        color: var(--muted-foreground);
        font-weight: 400;
    }

    .form-input,
    .form-select,
    .form-textarea {
        width: 100%;
        padding: 0.625rem 0.875rem;
        font-size: 0.9375rem;
        font-family: inherit;
        border: 1px solid var(--input);
        border-radius: 8px;
        background-color: var(--background);
        color: var(--foreground);
        transition: border-color 0.15s ease, box-shadow 0.15s ease;
        line-height: 1.5;
    }

    .form-input::placeholder,
    .form-textarea::placeholder {
        color: var(--muted-foreground);
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        outline: none;
        border-color: var(--ring);
        box-shadow: 0 0 0 2px var(--muted);
    }

    .form-input.is-invalid,
    .form-select.is-invalid,
    .form-textarea.is-invalid {
        border-color: var(--destructive);
    }

    .form-textarea {
        resize: vertical;
        min-height: 80px;
    }

    .form-select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2371717a'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.5rem center;
        background-size: 1rem;
        padding-right: 2rem;
    }

    .form-hint {
        font-size: 0.8125rem;
        color: var(--muted-foreground);
        margin-top: 0.5rem;
    }

    .form-error {
        font-size: 0.8125rem;
        color: var(--destructive);
        margin-top: 0.5rem;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1rem;
    }

    /* Toggle Switch - shadcn style */
    .toggle-switch {
        position: relative;
        display: inline-flex;
        align-items: center;
        height: 1.5rem;
        width: 2.75rem;
        flex-shrink: 0;
        cursor: pointer;
        border-radius: 9999px;
        border: 2px solid transparent;
        padding: 2px;
        background-color: var(--input);
        transition-property: background-color;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 200ms;
    }

    .toggle-switch:focus {
        outline: 2px solid transparent;
        outline-offset: 2px;
        --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
        --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) var(--ring);
        box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
        --tw-ring-offset-width: 2px;
    }

    .toggle-switch:disabled {
        cursor: not-allowed;
        opacity: 0.5;
    }

    .toggle-slider {
        pointer-events: none;
        display: inline-block;
        height: 1.25rem;
        width: 1.25rem;
        border-radius: 9999px;
        background-color: var(--background);
        box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        transition-property: transform;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 200ms;
    }

    /* Checkbox & Radio - shadcn style */
    .checkbox-input,
    .radio-input {
        width: 20px;
        height: 20px;
        border-radius: 5px;
        border: 1px solid var(--input);
        background-color: transparent;
        cursor: pointer;
        appearance: none;
        -webkit-appearance: none;
        transition: all 0.15s ease;
        position: relative;
        flex-shrink: 0;
    }

    .radio-input {
        border-radius: 50%;
    }

    .checkbox-input:checked,
    .radio-input:checked {
        background-color: var(--foreground);
        border-color: var(--foreground);
    }

    .checkbox-input:checked::after {
        content: '';
        position: absolute;
        left: 6px;
        top: 2px;
        width: 5px;
        height: 10px;
        border: solid var(--background);
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    .radio-input:checked::after {
        content: '';
        position: absolute;
        left: 5px;
        top: 5px;
        width: 8px;
        height: 8px;
        background: var(--background);
        border-radius: 50%;
    }

    /* Toggle Switch - shadcn style */
    .toggle-label {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        cursor: pointer;
    }

    .toggle-input {
        opacity: 0;
        width: 0;
        height: 0;
        position: absolute;
    }

    .toggle-slider {
        position: relative;
        width: 44px;
        height: 24px;
        background-color: var(--input);
        border-radius: 24px;
        transition: 0.2s;
        flex-shrink: 0;
    }

    .toggle-slider:before {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        left: 2px;
        bottom: 2px;
        background-color: white;
        transition: 0.2s;
        border-radius: 50%;
        box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.1);
    }

    .toggle-input:checked + .toggle-slider {
        background-color: var(--foreground);
    }

    .toggle-input:checked + .toggle-slider:before {
        transform: translateX(20px);
    }

    .toggle-text {
        font-size: 0.9375rem;
        font-weight: 500;
        color: var(--foreground);
    }

    /* Badges - shadcn style */
    .badge {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.25rem 0.625rem;
        font-size: 0.8125rem;
        font-weight: 500;
        border-radius: 9999px;
        line-height: 1.5;
    }

    .badge-primary {
        background-color: var(--muted);
        color: var(--foreground);
        border: 1px solid var(--border);
    }

    .badge-success {
        background-color: color-mix(in srgb, var(--success), transparent 90%);
        color: var(--success);
    }

    .badge-warning {
        background-color: color-mix(in srgb, var(--warning), transparent 90%);
        color: var(--warning);
    }

    .badge-danger {
        background-color: color-mix(in srgb, var(--destructive), transparent 90%);
        color: var(--destructive);
    }

    .badge-secondary {
        background-color: var(--accent);
        color: var(--muted-foreground);
    }

    .badge-info {
        background-color: color-mix(in srgb, var(--info), transparent 90%);
        color: var(--info);
    }

    /* Progress Bar - shadcn style */
    .progress-track {
        width: 100%;
        background-color: var(--muted);
        border-radius: 9999px;
        overflow: hidden;
    }

    .progress-bar {
        border-radius: 9999px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .progress-bar-primary {
        background-color: var(--primary);
    }

    .progress-bar-success {
        background-color: var(--success);
    }

    .progress-bar-warning {
        background-color: var(--warning);
    }

    .progress-bar-error {
        background-color: var(--destructive);
    }

    .progress-bar-info {
        background-color: var(--info);
    }

    .progress-label {
        font-size: 0.75rem;
        font-weight: 500;
        color: var(--primary-foreground);
    }

    /* Alerts - shadcn style */
    .alert {
        padding: 1rem;
        border-radius: 12px;
        border: 1px solid;
        margin-bottom: 1rem;
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
    }

    .alert .alert-icon {
        width: 16px;
        height: 16px;
        flex-shrink: 0;
        margin-top: 0.125rem;
    }

    .alert-content {
        flex: 1;
    }

    .alert-text {
        margin: 0;
        font-size: 0.9375rem;
        line-height: 1.4;
        color: inherit;
    }

    .alert-title-inline {
        font-weight: 700;
        margin-right: 0.25rem;
        color: inherit;
    }

    .alert-list {
        margin: 0.5rem 0 0;
        padding-left: 1.25rem;
        list-style: disc;
    }

    .alert-list li {
        font-size: 0.875rem;
        line-height: 1.4;
        margin-top: 0.25rem;
    }

    .alert-success {
        background-color: rgba(16, 185, 129, 0.12);
        border-color: rgba(16, 185, 129, 0.35);
        color: #065f46;
    }

    .alert-error {
        background-color: rgba(239, 68, 68, 0.10);
        border-color: rgba(239, 68, 68, 0.30);
        color: #991b1b;
    }

    .alert-warning {
        background-color: rgba(245, 158, 11, 0.12);
        border-color: rgba(245, 158, 11, 0.30);
        color: #92400e;
    }

    .alert-info {
        background-color: rgba(5, 150, 105, 0.10);
        border-color: rgba(5, 150, 105, 0.28);
        color: #065f46;
    }

    @media (min-width: 640px) {
        .alert {
            align-items: center;
        }
        .alert .alert-icon {
            margin-top: 0;
        }
    }

    /* Pagination */
    .pagination {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        justify-content: center;
        padding: 1rem;
    }

    .pagination a,
    .pagination span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 32px;
        height: 32px;
        padding: 0 0.5rem;
        font-size: 0.8125rem;
        font-weight: 500;
        border-radius: 6px;
        text-decoration: none;
        transition: all 0.15s ease;
    }

    .pagination a {
        color: var(--muted-foreground);
        background-color: var(--background);
        border: 1px solid var(--border);
    }

    .pagination a:hover {
        background-color: var(--muted);
        color: var(--foreground);
    }

    .pagination span.current {
        background-color: var(--foreground);
        color: var(--background);
        border: 1px solid var(--foreground);
    }

    .pagination span.disabled {
        color: var(--muted-foreground);
        cursor: not-allowed;
    }

    /* Laravel Pagination (Tailwind markup) */
    .pagination nav {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        width: 100%;
    }

    .pagination nav .sm\:hidden {
        display: flex;
        gap: 0.5rem;
        align-items: center;
        justify-content: space-between;
    }

    .pagination nav .hidden {
        display: none;
    }

    .pagination nav p {
        font-size: 0.8125rem;
        color: var(--muted-foreground);
    }

    .pagination nav p .font-medium {
        color: var(--foreground);
        font-weight: 600;
    }

    .pagination nav a,
    .pagination nav span[aria-current="page"] > span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 36px;
        height: 36px;
        padding: 0 0.75rem;
        font-size: 0.875rem;
        font-weight: 500;
        border-radius: 8px;
        border: 1px solid var(--border);
        background-color: var(--background);
        color: var(--foreground);
        text-decoration: none;
        transition: all 0.15s ease;
        box-shadow: var(--card-shadow);
    }

    .pagination nav a:hover {
        background-color: var(--muted);
        color: var(--foreground);
        border-color: color-mix(in srgb, var(--border), var(--foreground) 10%);
    }

    .pagination nav a[rel="prev"],
    .pagination nav a[rel="next"] {
        padding: 0 1rem;
        gap: 0.375rem;
    }

    .pagination nav span[aria-current="page"] > span {
        background-color: var(--foreground);
        color: var(--background);
        border-color: var(--foreground);
    }

    .pagination nav span[aria-disabled="true"] span,
    .pagination nav span[aria-disabled="true"] {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .pagination nav .shadow-sm {
        box-shadow: none;
    }

    .pagination nav .rounded-md,
    .pagination nav .rounded-l-md,
    .pagination nav .rounded-r-md {
        border-radius: 8px;
    }

    .pagination nav .-ml-px {
        margin-left: 0;
    }

    @media (min-width: 640px) {
        .pagination nav {
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }

        .pagination nav .sm\:hidden {
            display: none;
        }

        .pagination nav .hidden {
            display: flex;
            flex: 1;
            gap: 0.75rem;
            align-items: center;
            justify-content: space-between;
        }

        .pagination nav .inline-flex {
            border-radius: 10px;
            border: 1px solid var(--border);
            overflow: hidden;
            background-color: var(--background);
        }

        .pagination nav .inline-flex > a,
        .pagination nav .inline-flex > span > span {
            border-radius: 0;
            border: none;
            box-shadow: none;
            min-width: 38px;
        }

        .pagination nav .inline-flex > a + a,
        .pagination nav .inline-flex > a + span,
        .pagination nav .inline-flex > span + a,
        .pagination nav .inline-flex > span + span {
            border-left: 1px solid var(--border);
        }
    }

    /* Modal - shadcn style */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background-color: rgba(0, 0, 0, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        z-index: 200;
        opacity: 0;
        visibility: hidden;
        transition: all 0.2s ease;
    }

    .modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .modal {
        background: var(--background);
        border-radius: 12px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        max-width: 500px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        transform: scale(0.95);
        transition: transform 0.2s ease;
    }

    .modal-overlay.active .modal {
        transform: scale(1);
    }

    .modal-header {
        padding: 1.25rem;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .modal-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--foreground);
    }

    .modal-close {
        padding: 0.375rem;
        border: none;
        background: transparent;
        color: var(--muted-foreground);
        cursor: pointer;
        border-radius: 6px;
        transition: all 0.15s ease;
    }

    .modal-close:hover {
        background-color: var(--muted);
        color: var(--foreground);
    }

    .modal-close svg {
        width: 18px;
        height: 18px;
    }

    .modal-body {
        padding: 1.25rem;
    }

    .modal-footer {
        padding: 1rem 1.25rem;
        border-top: 1px solid var(--border);
        display: flex;
        justify-content: flex-end;
        gap: 0.5rem;
    }

    /* Search & Filters */
    .filters-bar {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .search-box {
        position: relative;
        flex: 1;
        min-width: 200px;
        max-width: 320px;
    }

    .search-box input {
        width: 100%;
        padding-left: 2.25rem;
    }

    .search-box svg {
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        width: 14px;
        height: 14px;
        color: var(--muted-foreground);
    }

    .filter-group {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .filter-label {
        font-size: 0.75rem;
        color: var(--muted-foreground);
        white-space: nowrap;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem 1.5rem;
    }

    .empty-state-icon {
        width: 48px;
        height: 48px;
        margin: 0 auto 1rem;
        color: var(--muted-foreground);
    }

    .empty-state-title {
        font-size: 0.9375rem;
        font-weight: 600;
        color: var(--foreground);
        margin-bottom: 0.25rem;
    }

    .empty-state-description {
        font-size: 0.8125rem;
        color: var(--muted-foreground);
        margin-bottom: 1.5rem;
    }

    /* User cell in tables */
    .user-cell {
        display: flex;
        align-items: center;
        gap: 0.625rem;
    }

    .user-cell-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--foreground);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--background);
        font-size: 0.6875rem;
        font-weight: 600;
        flex-shrink: 0;
    }

    .user-cell-name {
        font-weight: 500;
        color: var(--foreground);
        /* font-size: 0.8125rem; */
    }

    .user-cell-email {
        font-size: 0.75rem;
        color: var(--muted-foreground);
    }

    /* Action buttons */
    .action-buttons {
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .action-buttons form {
        display: flex;
        align-items: center;
    }

    .action-btn {
        padding: 0.5rem;
        border: none;
        background: transparent;
        color: var(--muted-foreground);
        cursor: pointer;
        border-radius: 6px;
        transition: all 0.15s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .action-btn:hover {
        background-color: var(--muted);
        color: var(--foreground);
    }

    .action-btn-danger:hover {
        background-color: color-mix(in srgb, var(--destructive), transparent 90%);
        color: var(--destructive);
    }

    .action-btn svg {
        width: 18px;
        height: 18px;
        display: block;
    }

    /* Badge list */
    .badge-list {
        display: flex;
        flex-wrap: wrap;
        gap: 0.25rem;
    }

    /* Grid layouts */
    /* KPI Stats Cards */
    .sp-kpi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-top: 0;
    }

    .sp-kpi-card {
        background: #ffffff !important;
        border: 1px solid #e5e7eb !important;
        border-radius: 1rem !important;
        padding: 1.25rem !important;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        min-height: 96px;
    }

    .dark .sp-kpi-card {
        background: #1a1a1a !important;
        border-color: #333333 !important;
    }

    .sp-kpi-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
    }

    .sp-kpi-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .sp-kpi-icon {
        width: 40px;
        height: 40px;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f3f4f6;
        color: #374151;
    }

    .transactions-page .sp-kpi-icon {
        width: 32px;
        height: 32px;
        border-radius: 0.65rem;
    }

    .transactions-page .sp-kpi-icon svg {
        width: 16px;
        height: 16px;
    }

    .dark .sp-kpi-icon {
        background: #262626;
        color: #d1d5db;
    }

    .sp-kpi-title {
        font-size: 0.8125rem;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }

    .dark .sp-kpi-title {
        color: #9ca3af;
    }

    .sp-kpi-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #111827;
    }

    .dark .sp-kpi-value {
        color: #ffffff;
    }

    .sp-kpi-icon.total { background: #eff6ff; color: #3b82f6; }
    .sp-kpi-icon.pending { background: #fff7ed; color: #f59e0b; }
    .sp-kpi-icon.created { background: #f5f3ff; color: #8b5cf6; }
    .sp-kpi-icon.completed { background: #ecfdf5; color: #10b981; }
    .sp-kpi-icon.withdrawal { background: #fef2f2; color: #ef4444; }

    .dark .sp-kpi-icon.total { background: rgba(59, 130, 246, 0.1); }
    .dark .sp-kpi-icon.pending { background: rgba(245, 158, 11, 0.1); }

        border-radius: 1rem !important;
        padding: 1.5rem !important;
        height: 220px;
        min-height: 220px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        display: flex;
        flex-direction: column;
        justify-content: center;
        width: 100%;
    }

    .dashboard-grid-bottom > .sp-virtual-card {
        min-height: 220px;
    }

    .dark .login-activity-card {
        background: #1a1a1a !important;
        border-color: #333333 !important;
    }

    .login-activity-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
    }

    .login-activity-title {
        font-weight: 700;
        color: #111827;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.95rem;
    }

    .dark .login-activity-title {
        color: #ffffff;
    }

    .login-activity-badge {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.25rem 0.5rem;
        border-radius: 999px;
        background: #ecfdf5;
        color: #065f46;
        border: 1px solid #d1fae5;
        white-space: nowrap;
    }

    .dark .login-activity-badge {
        background: rgba(16, 185, 129, 0.12);
        border-color: rgba(16, 185, 129, 0.2);
        color: #6ee7b7;
    }

    .login-activity-list {
        display: flex;
        flex-direction: column;
        gap: 0.85rem;
    }

    .login-activity-item {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 0.65rem 0.75rem;
        border-radius: 0.75rem;
        background: #f9fafb;
        border: 1px solid #f3f4f6;
    }

    .dark .login-activity-item {
        background: #141414;
        border-color: #262626;
    }

    .login-activity-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin-top: 0.35rem;
        background: #9ca3af;
        flex: 0 0 auto;
    }

    .login-activity-dot.success {
        background: #10b981;
    }

    .login-activity-meta {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
        width: 100%;
    }

    /* Transaction History Table Styles */
    .transaction-section {
        margin-top: 1.5rem;
        background: transparent;
        border-radius: 0;
        padding: 0;
        box-shadow: none;
        border: none;
    }

    .dark .transaction-section {
        background: transparent;
        border-color: transparent;
    }

    .transaction-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.75rem;
    }

    .transaction-filters {
        display: flex;
        align-items: flex-end;
        gap: 0.5rem;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    .tx-range-tabs {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.25rem;
        border-radius: 0.75rem;
        background: #f3f4f6;
        border: 1px solid #e5e7eb;
    }

    .dark .tx-range-tabs {
        background: #141414;
        border-color: #262626;
    }

    .tx-tab {
        height: 30px;
        padding: 0 0.6rem;
        border: none;
        background: transparent;
        border-radius: 0.6rem;
        font-size: 0.85rem;
        font-weight: 700;
        color: #6b7280;
        cursor: pointer;
        white-space: nowrap;
    }

    .dark .tx-tab {
        color: #9ca3af;
    }

    .tx-tab.active {
        background: #ffffff;
        color: #111827;
        border: 1px solid #e5e7eb;
    }

    .dark .tx-tab.active {
        background: #0f0f0f;
        color: #f9fafb;
        border-color: #262626;
    }

    .filter-group,
    .filter-label,
    .filter-input,
    .filter-btn {
        display: none;
    }

    .transaction-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #111827;
        margin: 0;
    }

    .dark .transaction-title {
        color: #f9fafb;
    }

    .transaction-table-container {
        overflow-x: auto;
        border-radius: 0.75rem;
        border: 1px solid #e5e7eb;
    }

    .dark .transaction-table-container {
        border-color: #262626;
    }

    .recent-payments-section {
        margin-top: 1rem;
    }

    .recent-payments-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        padding: 0.25rem 0;
        border-radius: 0;
        background: transparent;
        border: none;
        margin-bottom: 0.5rem;
    }

    .dark .recent-payments-header {
        background: transparent;
        border-color: transparent;
    }

    .recent-payments-title {
        font-weight: 700;
        color: #111827;
        font-size: 0.95rem;
    }

    .dark .recent-payments-title {
        color: #f9fafb;
    }

    .recent-payments-actions {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: nowrap;
        justify-content: flex-end;
    }

    .rp-btn {
        height: 30px;
        padding: 0 0.65rem;
        border-radius: 0.55rem;
        border: 1px solid #e5e7eb;
        background: #ffffff;
        color: #111827;
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        white-space: nowrap;
        flex: 0 0 auto;
    }

    .rp-btn.secondary {
        background: #111827;
        color: #ffffff;
        border-color: #111827;
    }

    .rp-btn.success {
        background: #059669;
        color: #ffffff;
        border-color: #059669;
    }

    .dark .rp-btn {
        background: #0f0f0f;
        border-color: #262626;
        color: #f9fafb;
    }

    .dark .rp-btn.secondary {
        background: #f9fafb;
        border-color: #f9fafb;
        color: #111827;
    }

    .dark .rp-btn.success {
        background: #059669;
        border-color: #059669;
        color: #ffffff;
    }

    .columns-wrapper {
        position: relative;
        flex: 0 0 auto;
    }

    .columns-menu {
        position: absolute;
        right: 0;
        top: calc(100% + 8px);
        min-width: 190px;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.10);
        padding: 0.5rem;
        display: none;
        z-index: 50;
    }

    .columns-menu.open {
        display: block;
    }

    .dark .columns-menu {
        background: #0f0f0f;
        border-color: #262626;
        box-shadow: 0 10px 30px rgba(0,0,0,0.35);
    }

    .columns-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.4rem 0.5rem;
        border-radius: 0.5rem;
        font-size: 0.85rem;
        color: #111827;
        cursor: pointer;
        user-select: none;
    }

    .columns-item:hover {
        background: #f3f4f6;
    }

    .dark .columns-item {
        color: #f9fafb;
    }

    .dark .columns-item:hover {
        background: #141414;
    }

    .col-hidden {
        display: none !important;
    }

    .table-pagination {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        margin-top: 0.75rem;
        flex-wrap: wrap;
    }

    .tx-table-shell {
        margin-top: 0.75rem;
        background: #f3f4f6;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        padding: 0.75rem;
    }

    .dark .tx-table-shell {
        background: #141414;
        border-color: #262626;
    }

    .tx-table-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        flex-wrap: wrap;
        margin-bottom: 0.5rem;
    }

    .tx-toolbar-left {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .tx-toolbar-right {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: nowrap;
    }

    .tx-table-subtoolbar {
        margin-bottom: 0.75rem;
    }

    .transactions-page .transaction-table-container {
        background: #ffffff;
        border-radius: 0.75rem;
    }

    .dark .transactions-page .transaction-table-container {
        background: #0f0f0f;
    }

    .transactions-page .transaction-table th {
        background: #e5e7eb;
        border-bottom-color: #e5e7eb;
    }

    .dark .transactions-page .transaction-table th {
        background: #141414;
        border-bottom-color: #262626;
    }

    .transactions-page .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 3rem 1.5rem;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
    }

    .dark .transactions-page .empty-state {
        background: #0f0f0f;
        border-color: #262626;
    }

    .empty-state-illustration {
        color: #6b7280;
    }

    .dark .empty-state-illustration {
        color: #9ca3af;
    }

    @media (max-width: 768px) {
        .table-pagination {
            flex-direction: column;
            align-items: flex-start;
        }

        .pagination-controls {
            width: 100%;
            justify-content: flex-start;
        }

        .tx-toolbar-right {
            width: 100%;
            justify-content: flex-start;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
    }

    .pagination-meta {
        font-size: 0.85rem;
        color: #6b7280;
    }

    .dark .pagination-meta {
        color: #9ca3af;
    }

    .pagination-controls {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    .page-numbers {
        display: flex;
        align-items: center;
        gap: 0.35rem;
    }

    .page-btn {
        height: 32px;
        min-width: 32px;
        padding: 0 0.6rem;
        border-radius: 0.6rem;
        border: 1px solid #e5e7eb;
        background: #ffffff;
        color: #111827;
        font-size: 0.85rem;
        font-weight: 700;
        cursor: pointer;
        white-space: nowrap;
    }

    .page-btn.active {
        background: #111827;
        color: #ffffff;
        border-color: #111827;
    }

    .page-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .dark .page-btn {
        background: #0f0f0f;
        border-color: #262626;
        color: #f9fafb;
    }

    .dark .page-btn.active {
        background: #f9fafb;
        border-color: #f9fafb;
        color: #111827;
    }

    .transaction-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.875rem;
    }

    .transaction-table th {
        background: #f9fafb;
        padding: 0.75rem 1rem;
        text-align: left;
        font-weight: 600;
        color: #374151;
        border-bottom: 1px solid #e5e7eb;
        white-space: nowrap;
    }

    .dark .transaction-table th {
        background: #141414;
        color: #d1d5db;
        border-color: #262626;
    }

    .transaction-table td {
        padding: 0.85rem 1rem;
        border-bottom: 1px solid #f3f4f6;
        vertical-align: middle;
    }

    .dark .transaction-table td {
        border-color: #1f1f1f;
    }

    .transaction-table tr:last-child td {
        border-bottom: none;
    }

    .transaction-table tr:hover {
        background: transparent;
    }

    .dark .transaction-table tr:hover {
        background: transparent;
    }

    .transaction-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .transaction-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .transaction-icon.incoming {
        background: #d1fae5;
        color: #10b981;
    }

    .dark .transaction-icon.incoming {
        background: rgba(16, 185, 129, 0.15);
        color: #34d399;
    }

    .transaction-icon.outgoing {
        background: #fee2e2;
        color: #ef4444;
    }

    .dark .transaction-icon.outgoing {
        background: rgba(239, 68, 68, 0.15);
        color: #f87171;
    }

    .transaction-name {
        font-weight: 600;
        color: #111827;
        margin-bottom: 0.125rem;
    }

    .dark .transaction-name {
        color: #f9fafb;
    }

    .transaction-date {
        color: #6b7280;
        font-size: 0.875rem;
        white-space: nowrap;
    }

    .dark .transaction-date {
        color: #9ca3af;
    }

    .badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
        white-space: nowrap;
    }

    .badge-neutral {
        background: #f3f4f6;
        color: #374151;
        border: 1px solid #e5e7eb;
    }

    .dark .badge-neutral {
        background: #141414;
        color: #d1d5db;
        border-color: #262626;
    }

    .transaction-amount {
        font-weight: 600;
        font-size: 0.875rem;
        white-space: nowrap;
    }

    .transaction-amount.positive {
        color: #10b981;
    }

    .dark .transaction-amount.positive {
        color: #34d399;
    }

    .transaction-amount.negative {
        color: #ef4444;
    }

    .dark .transaction-amount.negative {
        color: #f87171;
    }

    /* Responsive Transaction Table */
    @media (max-width: 768px) {
        .transaction-section {
            margin-top: 1.25rem;
            padding: 0;
            border-radius: 0;
        }

        .transaction-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .transaction-filters {
            width: 100%;
            justify-content: flex-start;
        }

        .recent-payments-header {
            flex-direction: row;
            align-items: center;
            flex-wrap: nowrap;
            background: none;
            border: none;
        }

        .recent-payments-actions {
            width: auto;
            justify-content: flex-end;
            flex-wrap: nowrap;
            max-width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .transaction-table th,
        .transaction-table td {
            padding: 0.75rem 0.5rem;
            font-size: 0.8rem;
        }

        .transaction-info {
            gap: 0.5rem;
        }

        .transaction-icon {
            width: 32px;
            height: 32px;
        }

        .transaction-name {
            font-size: 0.875rem;
        }
    }

    @media (max-width: 640px) {
        .transaction-table th:nth-child(3),
        .transaction-table td:nth-child(3) {
            display: none;
        }

        .transaction-table th,
        .transaction-table td {
            padding: 0.5rem 0.25rem;
            font-size: 0.75rem;
        }

        .transaction-icon {
            width: 28px;
            height: 28px;
        }

        .transaction-icon svg {
            width: 16px;
            height: 16px;
        }
    }

    .login-activity-line {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        width: 100%;
    }

    .login-activity-strong {
        font-weight: 700;
        color: #111827;
        font-size: 0.875rem;
    }

    .dark .login-activity-strong {
        color: #ffffff;
    }

    .login-activity-time {
        font-size: 0.75rem;
        color: #6b7280;
        white-space: nowrap;
    }

    .dark .login-activity-time {
        color: #9ca3af;
    }

    .login-activity-sub {
        font-size: 0.75rem;
        color: #6b7280;
        line-height: 1.2;
    }

    .dark .login-activity-sub {
        color: #9ca3af;
    }

    @media (max-width: 1024px) {
        .dashboard-grid-bottom {
            grid-template-columns: 1fr;
            margin-top: 1rem;
        }
        
        .welcome-card {
            padding: 1.5rem !important;
        }
        
        .welcome-title {
            font-size: 1.5rem;
        }
    }

    .welcome-card {
        background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05)), linear-gradient(135deg, #064e3b 0%, #065f46 50%, #059669 100%) !important;
        border-radius: 1rem !important;
        padding: 1.5rem 2rem !important;
        color: #ffffff !important;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        height: auto;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 0.75rem;
    }

    .welcome-content {
        display: flex;
        flex-direction: column;
        gap: 0.125rem;
    }

    .welcome-hello {
        color: #fbbf24 !important;
        font-size: 0.8125rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .welcome-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
        color: #ffffff !important;
    }

    .welcome-desc {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.8) !important;
        margin: 0;
        max-width: 600px;
        line-height: 1.4;
    }

    .welcome-desc b {
        color: #fbbf24 !important;
    }

    .welcome-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        margin-top: 0.25rem;
    }

    @media (max-width: 640px) {
        .welcome-card {
            padding: 1.25rem;
            gap: 1rem;
        }
        
        .welcome-card-footer {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.75rem;
        }
    }

    .dashboard-content-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(390px, 1fr));
        gap: 1.5rem;
        margin-top: 1.5rem;
    }

    .grid-2 {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    @media (max-width: 768px) {
        .grid-2 {
            grid-template-columns: 1fr;
        }
    }

    /* Checkbox list */
    .checkbox-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 0.5rem;
    }

    .checkbox-item {
        display: flex;
        align-items: flex-start;
        gap: 0.5rem;
        padding: 0.625rem;
        background-color: var(--muted);
        border-radius: 6px;
        transition: background-color 0.15s ease;
        cursor: pointer;
    }

    .checkbox-item:hover {
        background-color: var(--accent);
    }

    .checkbox-item-title {
        font-size: 0.8125rem;
        font-weight: 500;
        color: var(--foreground);
    }

    .checkbox-item-description {
        font-size: 0.6875rem;
        color: var(--muted-foreground);
        margin-top: 0.125rem;
    }

    /* Settings Navigation */
    .settings-nav {
        display: flex;
        gap: 0.25rem;
        margin-bottom: 1.5rem;
        padding: 0.25rem;
        background-color: var(--muted);
        border-radius: 8px;
        width: fit-content;
    }

    .settings-nav-item {
        display: flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.5rem 0.875rem;
        font-size: 0.8125rem;
        font-weight: 500;
        color: var(--muted-foreground);
        text-decoration: none;
        border-radius: 6px;
        transition: all 0.15s ease;
    }

    .settings-nav-item:hover {
        color: var(--foreground);
    }

    .settings-nav-item.active {
        color: var(--foreground);
        background-color: var(--background);
        box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    }

    .settings-nav-item svg {
        width: 14px;
        height: 14px;
    }

    /* Feature grid */
    .feature-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        gap: 0.75rem;
    }

    .feature-grid .form-group {
        margin-bottom: 0;
    }

    /* Form actions */
    .form-actions {
        display: flex;
        gap: 0.5rem;
        padding-top: 1rem;
        border-top: 1px solid var(--border);
    }

    /* Quick actions */
    .quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 0.5rem;
    }

    .quick-action-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.375rem;
        padding: 0.875rem;
        background-color: var(--muted);
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.15s ease;
        border: 1px solid transparent;
    }

    .quick-action-card:hover {
        background-color: var(--accent);
        border-color: var(--border);
    }

    .quick-action-icon {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--foreground);
    }

    .quick-action-icon svg {
        width: 16px;
        height: 16px;
        color: var(--background);
    }

    .quick-action-label {
        font-size: 0.75rem;
        font-weight: 500;
        color: var(--foreground);
        text-align: center;
    }

    /* Activity list */
    .activity-list {
        display: flex;
        flex-direction: column;
    }

    .activity-item {
        display: flex;
        gap: 0.625rem;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--border);
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background-color: var(--muted);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .activity-icon svg {
        width: 12px;
        height: 12px;
        color: var(--muted-foreground);
    }

    .activity-text {
        font-size: 0.8125rem;
        color: var(--foreground);
    }

    .activity-time {
        font-size: 0.6875rem;
        color: var(--muted-foreground);
        margin-top: 0.125rem;
    }

    /* Responsive */
    .sidebar-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 45;
    }

    @media (max-width: 1024px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .sidebar-overlay.active {
            display: block;
        }

        .main-content {
            margin-left: 0;
        }

        .mobile-menu-btn {
            display: flex;
        }
    }

    @media (max-width: 768px) {
        .page-header-row {
            flex-direction: column;
            align-items: flex-start;
        }

        .filters-bar {
            flex-direction: column;
            align-items: stretch;
        }

        .search-box {
            max-width: none;
        }

        .user-dropdown-btn .user-info {
            display: none;
        }

        .table th,
        .table td {
            padding: 0.625rem 0.5rem;
        }

        .page-content {
            padding: 1rem;
        }
    }

    /* Tabs */
    .tabs {
        display: flex;
        gap: 0;
        border-bottom: 1px solid var(--border);
        margin-bottom: 1.5rem;
    }

    .tab-link {
        padding: 0.625rem 1rem;
        font-size: 0.8125rem;
        font-weight: 500;
        color: var(--muted-foreground);
        text-decoration: none;
        border-bottom: 2px solid transparent;
        margin-bottom: -1px;
        transition: all 0.15s ease;
    }

    .tab-link:hover {
        color: var(--foreground);
    }

    .tab-link.active {
        color: var(--foreground);
        border-bottom-color: var(--foreground);
    }

    /* Spinner */
    .spinner {
        width: 16px;
        height: 16px;
        border: 2px solid var(--border);
        border-top-color: var(--foreground);
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    /* Profile avatar */
    .profile-avatar-section {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid var(--border);
    }

    .profile-avatar {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: var(--foreground);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--background);
        font-size: 1.5rem;
        font-weight: 600;
        flex-shrink: 0;
    }

    .profile-avatar-info h3 {
        font-size: 1rem;
        font-weight: 600;
        color: var(--foreground);
        margin-bottom: 0.125rem;
    }

    .profile-avatar-info p {
        font-size: 0.8125rem;
        color: var(--muted-foreground);
    }

    /* Gallery Component - Lightbox Overlay */
    .gallery-lightbox-overlay {
        background-color: rgba(0, 0, 0, 0.9);
    }

    .gallery-lightbox-button {
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
        transition: background-color 0.15s ease;
    }

    .gallery-lightbox-button:hover {
        background-color: rgba(255, 255, 255, 0.2);
    }

    /* Gallery thumbnail overlay */
    .gallery-thumbnail-overlay {
        background-color: transparent;
        transition: background-color 0.2s ease;
    }

    .gallery-thumbnail-overlay:hover {
        background-color: rgba(0, 0, 0, 0.2);
    }

    /* Code Block Syntax Highlighting (One Dark theme) */
    .code-block-pre {
        background-color: #282c34;
        color: #abb2bf;
    }

    /* Component Success State */
    .component-success-text {
        color: var(--success);
    }

    /* Component Warning State */
    .component-warning-text {
        color: var(--warning);
    }

    /* Component Info State */
    .component-info-text {
        color: var(--info);
    }

    /* Component Danger/Error State */
    .component-danger-text {
        color: var(--destructive);
    }

    /* Utility Classes for Components */
    .bg-primary {
        background-color: var(--primary);
    }

    .bg-secondary {
        background-color: var(--secondary);
    }

    .bg-destructive {
        background-color: var(--destructive);
    }

    .bg-muted {
        background-color: var(--muted);
    }

    .bg-accent {
        background-color: var(--accent);
    }

    .bg-background {
        background-color: var(--background);
    }

    .bg-card {
        background-color: var(--card);
    }

    .bg-popover {
        background-color: var(--popover);
    }

    .text-primary {
        color: var(--primary);
    }

    .text-primary-foreground {
        color: var(--primary-foreground);
    }

    .text-secondary-foreground {
        color: var(--secondary-foreground);
    }

    .text-destructive {
        color: var(--destructive);
    }

    .text-destructive-foreground {
        color: var(--destructive-foreground);
    }

    .text-muted-foreground {
        color: var(--muted-foreground);
    }

    .text-accent-foreground {
        color: var(--accent-foreground);
    }

    .text-foreground {
        color: var(--foreground);
    }

    .border-input {
        border-color: var(--input);
    }

    .border-destructive {
        border-color: var(--destructive);
    }

    .border-primary {
        border-color: var(--primary);
    }

    .hover\:bg-accent:hover {
        background-color: var(--accent);
    }

    .hover\:bg-primary\/90:hover {
        background-color: color-mix(in srgb, var(--primary), transparent 10%);
    }

    .hover\:bg-destructive\/90:hover {
        background-color: color-mix(in srgb, var(--destructive), transparent 10%);
    }

    .hover\:bg-accent\/50:hover {
        background-color: color-mix(in srgb, var(--accent), transparent 50%);
    }

    .hover\:text-accent-foreground:hover {
        color: var(--accent-foreground);
    }

    .hover\:text-primary-foreground\/80:hover {
        color: color-mix(in srgb, var(--primary-foreground), transparent 20%);
    }

    .hover\:bg-destructive\/10:hover {
        background-color: color-mix(in srgb, var(--destructive), transparent 90%);
    }

    .bg-muted\/50 {
        background-color: color-mix(in srgb, var(--muted), transparent 50%);
    }

    .bg-muted\/30 {
        background-color: color-mix(in srgb, var(--muted), transparent 70%);
    }

    .hover\:bg-muted\/50:hover {
        background-color: color-mix(in srgb, var(--muted), transparent 50%);
    }

    .bg-primary\/5 {
        background-color: color-mix(in srgb, var(--primary), transparent 95%);
    }

    .hover\:bg-background:hover {
        background-color: var(--background);
    }

    .placeholder\:text-muted-foreground::placeholder {
        color: var(--muted-foreground);
    }

    .ring-offset-background {
        --tw-ring-offset-color: var(--background);
    }

    .focus-visible\:ring-ring:focus-visible {
        --tw-ring-color: var(--ring);
    }

    .focus-visible\:ring-2:focus-visible {
        --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
        --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color);
        box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
    }

    .focus-visible\:ring-offset-2:focus-visible {
        --tw-ring-offset-width: 2px;
    }

    .focus-visible\:outline-none:focus-visible {
        outline: 2px solid transparent;
        outline-offset: 2px;
    }

    .focus-within\:ring-2:focus-within {
        --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
        --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color);
        box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
    }

    .focus-within\:ring-ring:focus-within {
        --tw-ring-color: var(--ring);
    }

    .focus-within\:ring-offset-2:focus-within {
        --tw-ring-offset-width: 2px;
    }

    .accent-primary {
        accent-color: var(--primary);
    }

    /* File input styling */
    input[type="file"]::file-selector-button,
    .file\:border-0::file-selector-button {
        border-width: 0;
    }

    input[type="file"]::file-selector-button,
    .file\:bg-transparent::file-selector-button {
        background-color: transparent;
    }

    input[type="file"]::file-selector-button,
    .file\:text-sm::file-selector-button {
        font-size: 0.875rem;
        line-height: 1.25rem;
    }

    input[type="file"]::file-selector-button,
    .file\:font-medium::file-selector-button {
        font-weight: 500;
    }

    /* Transform utilities */
    .transform {
        transform: var(--tw-transform);
    }

    .-translate-y-1\/2 {
        transform: translateY(-50%);
    }

    .translate-x-0 {
        transform: translateX(0);
    }

    .translate-x-5 {
        transform: translateX(1.25rem);
    }

    .-translate-x-1\/2 {
        transform: translateX(-50%);
    }

    /* Transition utilities */
    .transition-colors {
        transition-property: color, background-color, border-color, text-decoration-color, fill, stroke;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 150ms;
    }

    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 150ms;
    }

    .duration-200 {
        transition-duration: 200ms;
    }

    .duration-300 {
        transition-duration: 300ms;
    }

    .ease-in-out {
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }
</style>
