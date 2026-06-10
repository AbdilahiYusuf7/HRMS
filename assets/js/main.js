/**
 * Aeroport Operations Console - Interactivity & UI Handler
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Initialize Real-Time Clock
    initAirportClock();

    // 2. Setup Responsive Sidebar Toggle for Mobile Devices
    initSidebarToggle();

    // 3. Setup Sidebar Submenu Toggle
    initSidebarSubmenus();

    // 4. Setup User Profile Dropdown interactions
    initProfileDropdown();

    // 5. Custom Login Interactivity (on login page)
    initLoginInteractivity();

    // 6. Setup Chart Hover Tooltips
    initChartTooltips();

    // 7. Setup HRM Dashboard Modals
    initHrmModals();

    // 8. Setup Employee Tables
    initEmployeeTables();

    // 9. Setup Employee Profile Tabs
    initEmployeeProfileTabs();

    // 10. Setup Attendance Tables
    initAttendanceTables();

    // 11. Setup Warning Tables
    initWarningTables();

    // 12. Setup Leave Tables
    initLeaveTables();

    // 13. Setup Promotion Tables
    initPromotionTables();

    // 14. Setup Payroll Tables
    initPayrollTables();

    // 15. Setup Training Tables
    initTrainingTables();

    // 16. Setup Pension Tables
    initPensionTables();

    // 17. Setup Roster Tables
    initRosterTables();

    // 18. Setup Document Tables
    initDocumentTables();

    // 19. Setup Document Preview
    initDocumentPreview();
});

/**
 * Updates the clock display with the current time in 24-hour format
 */
function initAirportClock() {
    const clockDisplay = document.getElementById('clock-display');
    if (!clockDisplay) return;

    function updateTime() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        
        clockDisplay.innerHTML = `<strong style="color: var(--secondary-color);">${hours}:${minutes}:${seconds}</strong>`;
    }

    // Run clock updates immediately and schedule periodic redraws
    updateTime();
    setInterval(updateTime, 1000);
}

/**
 * Handles toggling the sidebar navigation on mobile viewports
 */
function initSidebarToggle() {
    const menuToggleBtn = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');

    if (!menuToggleBtn || !sidebar) return;

    menuToggleBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        sidebar.classList.toggle('active');
    });

    // Close sidebar when clicking anywhere outside of it
    document.addEventListener('click', (e) => {
        if (sidebar.classList.contains('active') && !sidebar.contains(e.target) && e.target !== menuToggleBtn) {
            sidebar.classList.remove('active');
        }
    });
}

/**
 * Handles expandable sidebar submenu groups
 */
function initSidebarSubmenus() {
    const submenuItems = document.querySelectorAll('.sidebar-menu-item.has-submenu');
    if (!submenuItems.length) return;

    function clearSidebarActiveState() {
        document.querySelectorAll('.sidebar-menu-item.active').forEach(item => {
            item.classList.remove('active');
        });

        document.querySelectorAll('.sidebar-submenu li.active').forEach(item => {
            item.classList.remove('active');
        });
    }

    function closeAllSubmenus() {
        submenuItems.forEach(item => {
            setSubmenuExpanded(item, false);
        });
    }

    function setSubmenuExpanded(item, isExpanded) {
        const trigger = Array.from(item.children).find(child => child.matches('a.submenu-toggle'));

        item.classList.toggle('open', isExpanded);

        if (trigger) {
            trigger.setAttribute('aria-expanded', isExpanded ? 'true' : 'false');
        }
    }

    function activateSubmenuLink(link) {
        const submenuItem = link.closest('.sidebar-menu-item.has-submenu');
        const submenuLinkItem = link.parentElement;
        const submenuList = link.closest('.sidebar-submenu');

        if (!submenuItem || !submenuLinkItem || !submenuList) return;

        clearSidebarActiveState();
        submenuItem.classList.add('active');
        submenuLinkItem.classList.add('active');
        setSubmenuExpanded(submenuItem, true);
        submenuList.style.setProperty('--active-line-height', `${submenuLinkItem.offsetTop + (submenuLinkItem.offsetHeight / 2)}px`);
    }

    function activateCurrentHash() {
        if (!window.location.hash) return;

        const activeLink = document.querySelector(`.sidebar-submenu a[href="${window.location.hash}"]`);

        if (activeLink) {
            activateSubmenuLink(activeLink);
        }
    }

    function refreshOpenActiveSubmenuLines() {
        document.querySelectorAll('.sidebar-submenu li.active a').forEach(link => {
            const submenuItem = link.closest('.sidebar-menu-item.has-submenu');
            const submenuLinkItem = link.parentElement;
            const submenuList = link.closest('.sidebar-submenu');

            if (submenuItem && submenuItem.classList.contains('open') && submenuLinkItem && submenuList) {
                submenuList.style.setProperty('--active-line-height', `${submenuLinkItem.offsetTop + (submenuLinkItem.offsetHeight / 2)}px`);
            }
        });
    }

    submenuItems.forEach(item => {
        const trigger = Array.from(item.children).find(child => child.matches('a.submenu-toggle'));
        if (!trigger) return;

        trigger.addEventListener('click', (e) => {
            e.preventDefault();
            setSubmenuExpanded(item, !item.classList.contains('open'));
        });

        const submenuLinks = item.querySelectorAll('.sidebar-submenu li a');
        submenuLinks.forEach(link => {
            link.addEventListener('click', () => {
                activateSubmenuLink(link);
            });
        });
    });

    document.querySelectorAll('.sidebar-menu-item:not(.has-submenu) > a').forEach(link => {
        link.addEventListener('click', () => {
            closeAllSubmenus();
            clearSidebarActiveState();
            link.parentElement.classList.add('active');
        });
    });

    window.addEventListener('hashchange', activateCurrentHash);
    window.addEventListener('resize', refreshOpenActiveSubmenuLines);
}

/**
 * Manages simple transitions or menu actions on user profiles
 */
function initProfileDropdown() {
    const profileDropdown = document.getElementById('user-profile-dropdown');
    if (!profileDropdown) return;

    profileDropdown.addEventListener('click', (e) => {
        // Toggle user visual feedback
        profileDropdown.style.backgroundColor = 'rgba(77, 168, 218, 0.1)';
        setTimeout(() => {
            profileDropdown.style.backgroundColor = '';
        }, 150);
        
        console.log("Profile Dropdown Triggered.");
    });
}

/**
 * Injects helpful client-side interactivity on the login page
 */
function initLoginInteractivity() {
    const loginForm = document.getElementById('login-form');
    if (!loginForm) return;

    // Enhance inputs with focus highlighting class triggers
    const inputs = loginForm.querySelectorAll('.login-form-control');
    inputs.forEach(input => {
        input.addEventListener('focus', () => {
            input.parentElement.classList.add('focused');
        });
        input.addEventListener('blur', () => {
            input.parentElement.classList.remove('focused');
        });
    });

    // Password visibility toggle feature
    const passwordToggle = document.getElementById('password-toggle');
    const passwordInput = document.getElementById('password');
    if (passwordToggle && passwordInput) {
        passwordToggle.addEventListener('click', () => {
            const isPassword = passwordInput.getAttribute('type') === 'password';
            passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
            passwordToggle.textContent = isPassword ? 'visibility_off' : 'visibility';
        });
    }

    // Simulate authentication processing visual styles on submit
    loginForm.addEventListener('submit', (e) => {
        const submitBtn = loginForm.querySelector('.login-btn-submit');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.style.opacity = '0.8';
            submitBtn.style.cursor = 'wait';
            
            const btnSpan = submitBtn.querySelector('span');
            if (btnSpan) {
                btnSpan.innerText = 'Verifying Credentials...';
            }
        }
    });
}

/**
 * Chart.js tooltip styling aligned with .chart-tooltip
 */
function hrmChartTooltipOptions(overrides = {}) {
    return {
        enabled: true,
        backgroundColor: '#0f172a',
        titleColor: '#ffffff',
        bodyColor: 'rgba(255, 255, 255, 0.72)',
        footerColor: 'rgba(255, 255, 255, 0.72)',
        padding: 12,
        cornerRadius: 8,
        titleFont: { family: 'Outfit, sans-serif', size: 13, weight: '700' },
        bodyFont: { family: 'Outfit, sans-serif', size: 12, weight: '600' },
        footerFont: { family: 'Outfit, sans-serif', size: 12, weight: '600' },
        displayColors: true,
        boxPadding: 6,
        caretPadding: 8,
        borderWidth: 0,
        ...overrides
    };
}

window.hrmChartTooltipOptions = hrmChartTooltipOptions;

/**
 * Displays compact hover details for dashboard chart elements
 */
function initChartTooltips() {
    const chartItems = document.querySelectorAll('[data-chart-title][data-chart-value]');
    if (!chartItems.length) return;

    const tooltip = document.createElement('div');
    tooltip.className = 'chart-tooltip';
    tooltip.innerHTML = '<strong></strong><span></span>';
    document.body.appendChild(tooltip);

    const tooltipTitle = tooltip.querySelector('strong');
    const tooltipValue = tooltip.querySelector('span');

    function getPageZoom() {
        const zoom = parseFloat(window.getComputedStyle(document.body).zoom);
        return Number.isFinite(zoom) && zoom > 0 ? zoom : 1;
    }

    function moveTooltipToItem(item) {
        const rect = item.getBoundingClientRect();
        const zoom = getPageZoom();
        const left = (window.scrollX + rect.left + (rect.width / 2)) / zoom;
        const top = (window.scrollY + rect.top + (rect.height / 2)) / zoom;

        tooltip.style.left = `${left}px`;
        tooltip.style.top = `${top}px`;
    }

    chartItems.forEach(item => {
        item.addEventListener('mouseenter', () => {
            tooltipTitle.textContent = item.dataset.chartTitle || '';
            tooltipValue.textContent = item.dataset.chartValue || '';
            moveTooltipToItem(item);
            tooltip.classList.add('visible');
        });

        item.addEventListener('mousemove', () => {
            moveTooltipToItem(item);
        });

        item.addEventListener('mouseleave', () => {
            tooltip.classList.remove('visible');
        });
    });
}

/**
 * Handles HRM insight card data modals
 */
function initHrmModals() {
    const modalTriggers = document.querySelectorAll('[data-hrm-modal-target]');
    const modals = document.querySelectorAll('.hrm-modal');

    if (!modalTriggers.length || !modals.length) return;

    function closeModal(modal) {
        modal.classList.remove('open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('hrm-modal-open');
    }

    function closeAllModals() {
        modals.forEach(closeModal);
    }

    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (!modal) return;

        closeAllModals();
        modal.classList.add('open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('hrm-modal-open');

        const closeButton = modal.querySelector('[data-hrm-modal-close]');
        if (closeButton) {
            closeButton.focus();
        }
    }

    modalTriggers.forEach(trigger => {
        trigger.addEventListener('click', () => {
            openModal(trigger.dataset.hrmModalTarget);
        });
    });

    document.querySelectorAll('[data-hrm-modal-close]').forEach(closeTrigger => {
        closeTrigger.addEventListener('click', () => {
            const modal = closeTrigger.closest('.hrm-modal');
            if (modal) {
                closeModal(modal);
            }
        });
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeAllModals();
        }
    });
}

/**
 * Provides filtering, sorting, and pagination for employee records tables
 */
function initEmployeeTables() {
    const tablePanels = document.querySelectorAll('[data-employee-table]');
    if (!tablePanels.length) return;

    tablePanels.forEach(panel => {
        const table = panel.querySelector('.employee-data-table');
        const tbody = table ? table.querySelector('tbody') : null;
        const summary = panel.querySelector('[data-employee-table-summary]');
        const pagination = panel.querySelector('[data-employee-pagination]');
        const filters = document.querySelectorAll('[data-employee-filter]');

        if (!table || !tbody || !summary || !pagination) return;

        const pageSize = 4;
        const allRows = Array.from(tbody.querySelectorAll('tr'));
        let currentPage = 1;
        let sortKey = '';
        let sortDirection = 'asc';

        function getFilterValue(name) {
            const filter = document.querySelector(`[data-employee-filter="${name}"]`);
            return filter ? filter.value.trim().toLowerCase() : '';
        }

        function getRowValue(row, key) {
            return (row.dataset[key] || '').trim();
        }

        function getFilteredRows() {
            const department = getFilterValue('department');
            const date = getFilterValue('date');
            const search = getFilterValue('search');

            return allRows.filter(row => {
                const rowDepartment = getRowValue(row, 'department').toLowerCase();
                const rowDate = getRowValue(row, 'joinDate').toLowerCase();
                const rowName = getRowValue(row, 'name').toLowerCase();
                const rowNumber = getRowValue(row, 'number').toLowerCase();

                return (!department || rowDepartment === department)
                    && (!date || rowDate === date)
                    && (!search || rowName.includes(search) || rowNumber.includes(search));
            });
        }

        function sortRows(rows) {
            if (!sortKey) return rows;

            return [...rows].sort((a, b) => {
                const aValue = getRowValue(a, sortKey);
                const bValue = getRowValue(b, sortKey);

                if (sortKey === 'joinDate') {
                    return sortDirection === 'asc'
                        ? new Date(aValue) - new Date(bValue)
                        : new Date(bValue) - new Date(aValue);
                }

                return sortDirection === 'asc'
                    ? aValue.localeCompare(bValue)
                    : bValue.localeCompare(aValue);
            });
        }

        function renderPagination(totalPages) {
            pagination.innerHTML = '';

            const previousButton = document.createElement('button');
            previousButton.type = 'button';
            previousButton.textContent = '<';
            previousButton.disabled = currentPage === 1;
            previousButton.addEventListener('click', () => {
                currentPage -= 1;
                render();
            });
            pagination.appendChild(previousButton);

            for (let page = 1; page <= totalPages; page += 1) {
                const button = document.createElement('button');
                button.type = 'button';
                button.textContent = page;
                button.classList.toggle('active', page === currentPage);
                button.addEventListener('click', () => {
                    currentPage = page;
                    render();
                });
                pagination.appendChild(button);
            }

            const nextButton = document.createElement('button');
            nextButton.type = 'button';
            nextButton.textContent = '>';
            nextButton.disabled = currentPage === totalPages;
            nextButton.addEventListener('click', () => {
                currentPage += 1;
                render();
            });
            pagination.appendChild(nextButton);
        }

        function render() {
            const filteredRows = sortRows(getFilteredRows());
            const totalPages = Math.max(1, Math.ceil(filteredRows.length / pageSize));

            if (currentPage > totalPages) {
                currentPage = totalPages;
            }

            const start = (currentPage - 1) * pageSize;
            const pageRows = filteredRows.slice(start, start + pageSize);

            allRows.forEach(row => {
                row.style.display = 'none';
            });

            pageRows.forEach(row => {
                row.style.display = '';
                tbody.appendChild(row);
            });

            const from = filteredRows.length ? start + 1 : 0;
            const to = Math.min(start + pageSize, filteredRows.length);
            summary.textContent = `Showing ${from}-${to} of ${filteredRows.length} employees`;
            renderPagination(totalPages);
        }

        table.querySelectorAll('[data-sort-key]').forEach(button => {
            button.addEventListener('click', () => {
                const nextSortKey = button.dataset.sortKey;

                if (sortKey === nextSortKey) {
                    sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
                } else {
                    sortKey = nextSortKey;
                    sortDirection = 'asc';
                }

                currentPage = 1;
                render();
            });
        });

        filters.forEach(filter => {
            filter.addEventListener('input', () => {
                currentPage = 1;
                render();
            });

            filter.addEventListener('change', () => {
                currentPage = 1;
                render();
            });
        });

        render();
    });
}

/**
 * Switches employee profile tab panels
 */
function initEmployeeProfileTabs() {
    const tabLinks = document.querySelectorAll('[data-employee-tab-target]');
    const panels = document.querySelectorAll('[data-employee-tab-panel]');

    if (!tabLinks.length || !panels.length) return;

    function activateTab(target) {
        tabLinks.forEach(link => {
            link.classList.toggle('active', link.dataset.employeeTabTarget === target);
        });

        panels.forEach(panel => {
            panel.classList.toggle('active', panel.dataset.employeeTabPanel === target);
        });
    }

    tabLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            activateTab(link.dataset.employeeTabTarget);
        });
    });
}

/**
 * Provides sorting and pagination for employee attendance logs
 */
function initAttendanceTables() {
    const tablePanels = document.querySelectorAll('[data-attendance-table]');
    if (!tablePanels.length) return;

    tablePanels.forEach(panel => {
        const table = panel.querySelector('.employee-data-table');
        const tbody = table ? table.querySelector('tbody') : null;
        const summary = panel.querySelector('[data-attendance-table-summary]');
        const pagination = panel.querySelector('[data-attendance-pagination]');

        if (!table || !tbody || !summary || !pagination) return;

        const pageSize = 4;
        const allRows = Array.from(tbody.querySelectorAll('tr'));
        let currentPage = 1;
        let sortKey = '';
        let sortDirection = 'asc';

        function getRowValue(row, key) {
            return (row.dataset[key] || '').trim();
        }

        function sortRows(rows) {
            if (!sortKey) return rows;

            return [...rows].sort((a, b) => {
                const aValue = getRowValue(a, sortKey);
                const bValue = getRowValue(b, sortKey);

                if (sortKey === 'date') {
                    return sortDirection === 'asc'
                        ? new Date(aValue) - new Date(bValue)
                        : new Date(bValue) - new Date(aValue);
                }

                return sortDirection === 'asc'
                    ? aValue.localeCompare(bValue, undefined, { numeric: true })
                    : bValue.localeCompare(aValue, undefined, { numeric: true });
            });
        }

        function renderPagination(totalPages) {
            pagination.innerHTML = '';

            const previousButton = document.createElement('button');
            previousButton.type = 'button';
            previousButton.textContent = '<';
            previousButton.disabled = currentPage === 1;
            previousButton.addEventListener('click', () => {
                currentPage -= 1;
                render();
            });
            pagination.appendChild(previousButton);

            for (let page = 1; page <= totalPages; page += 1) {
                const button = document.createElement('button');
                button.type = 'button';
                button.textContent = page;
                button.classList.toggle('active', page === currentPage);
                button.addEventListener('click', () => {
                    currentPage = page;
                    render();
                });
                pagination.appendChild(button);
            }

            const nextButton = document.createElement('button');
            nextButton.type = 'button';
            nextButton.textContent = '>';
            nextButton.disabled = currentPage === totalPages;
            nextButton.addEventListener('click', () => {
                currentPage += 1;
                render();
            });
            pagination.appendChild(nextButton);
        }

        function render() {
            const sortedRows = sortRows(allRows);
            const totalPages = Math.max(1, Math.ceil(sortedRows.length / pageSize));

            if (currentPage > totalPages) {
                currentPage = totalPages;
            }

            const start = (currentPage - 1) * pageSize;
            const pageRows = sortedRows.slice(start, start + pageSize);

            allRows.forEach(row => {
                row.style.display = 'none';
            });

            pageRows.forEach(row => {
                row.style.display = '';
                tbody.appendChild(row);
            });

            summary.textContent = `Showing ${start + 1}-${Math.min(start + pageSize, sortedRows.length)} of ${sortedRows.length} records`;
            renderPagination(totalPages);
        }

        table.querySelectorAll('[data-attendance-sort-key]').forEach(button => {
            button.addEventListener('click', () => {
                const nextSortKey = button.dataset.attendanceSortKey;

                if (sortKey === nextSortKey) {
                    sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
                } else {
                    sortKey = nextSortKey;
                    sortDirection = 'asc';
                }

                currentPage = 1;
                render();
            });
        });

        render();
    });
}

/**
 * Provides sorting and pagination for employee warning tables
 */
function initWarningTables() {
    const tablePanels = document.querySelectorAll('[data-warning-table]');
    if (!tablePanels.length) return;

    tablePanels.forEach(panel => {
        const table = panel.querySelector('.employee-data-table');
        const tbody = table ? table.querySelector('tbody') : null;
        const summary = panel.querySelector('[data-warning-table-summary]');
        const pagination = panel.querySelector('[data-warning-pagination]');

        if (!table || !tbody || !summary || !pagination) return;

        const pageSize = 4;
        const allRows = Array.from(tbody.querySelectorAll('tr'));
        let currentPage = 1;
        let sortKey = '';
        let sortDirection = 'asc';

        function getRowValue(row, key) {
            return (row.dataset[key] || '').trim();
        }

        function sortRows(rows) {
            if (!sortKey) return rows;

            return [...rows].sort((a, b) => {
                const aValue = getRowValue(a, sortKey);
                const bValue = getRowValue(b, sortKey);

                if (sortKey === 'date') {
                    return sortDirection === 'asc'
                        ? new Date(aValue) - new Date(bValue)
                        : new Date(bValue) - new Date(aValue);
                }

                return sortDirection === 'asc'
                    ? aValue.localeCompare(bValue)
                    : bValue.localeCompare(aValue);
            });
        }

        function renderPagination(totalPages) {
            pagination.innerHTML = '';

            const previousButton = document.createElement('button');
            previousButton.type = 'button';
            previousButton.textContent = '<';
            previousButton.disabled = currentPage === 1;
            previousButton.addEventListener('click', () => {
                currentPage -= 1;
                render();
            });
            pagination.appendChild(previousButton);

            for (let page = 1; page <= totalPages; page += 1) {
                const button = document.createElement('button');
                button.type = 'button';
                button.textContent = page;
                button.classList.toggle('active', page === currentPage);
                button.addEventListener('click', () => {
                    currentPage = page;
                    render();
                });
                pagination.appendChild(button);
            }

            const nextButton = document.createElement('button');
            nextButton.type = 'button';
            nextButton.textContent = '>';
            nextButton.disabled = currentPage === totalPages;
            nextButton.addEventListener('click', () => {
                currentPage += 1;
                render();
            });
            pagination.appendChild(nextButton);
        }

        function render() {
            const sortedRows = sortRows(allRows);
            const totalPages = Math.max(1, Math.ceil(sortedRows.length / pageSize));

            if (currentPage > totalPages) {
                currentPage = totalPages;
            }

            const start = (currentPage - 1) * pageSize;
            const pageRows = sortedRows.slice(start, start + pageSize);

            allRows.forEach(row => {
                row.style.display = 'none';
            });

            pageRows.forEach(row => {
                row.style.display = '';
                tbody.appendChild(row);
            });

            summary.textContent = `Showing ${start + 1}-${Math.min(start + pageSize, sortedRows.length)} of ${sortedRows.length} warnings`;
            renderPagination(totalPages);
        }

        table.querySelectorAll('[data-warning-sort-key]').forEach(button => {
            button.addEventListener('click', () => {
                const nextSortKey = button.dataset.warningSortKey;

                if (sortKey === nextSortKey) {
                    sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
                } else {
                    sortKey = nextSortKey;
                    sortDirection = 'asc';
                }

                currentPage = 1;
                render();
            });
        });

        render();
    });
}

/**
 * Provides sorting and pagination for employee leave history tables
 */
function initLeaveTables() {
    const tablePanels = document.querySelectorAll('[data-leave-table]');
    if (!tablePanels.length) return;

    tablePanels.forEach(panel => {
        const table = panel.querySelector('.employee-data-table');
        const tbody = table ? table.querySelector('tbody') : null;
        const summary = panel.querySelector('[data-leave-table-summary]');
        const pagination = panel.querySelector('[data-leave-pagination]');

        if (!table || !tbody || !summary || !pagination) return;

        const pageSize = 4;
        const allRows = Array.from(tbody.querySelectorAll('tr'));
        let currentPage = 1;
        let sortKey = '';
        let sortDirection = 'asc';

        function getRowValue(row, key) {
            return (row.dataset[key] || '').trim();
        }

        function sortRows(rows) {
            if (!sortKey) return rows;

            return [...rows].sort((a, b) => {
                const aValue = getRowValue(a, sortKey);
                const bValue = getRowValue(b, sortKey);

                if (['appliedOn', 'startDate', 'endDate'].includes(sortKey)) {
                    return sortDirection === 'asc'
                        ? new Date(aValue) - new Date(bValue)
                        : new Date(bValue) - new Date(aValue);
                }

                if (sortKey === 'days') {
                    return sortDirection === 'asc'
                        ? Number(aValue) - Number(bValue)
                        : Number(bValue) - Number(aValue);
                }

                return sortDirection === 'asc'
                    ? aValue.localeCompare(bValue)
                    : bValue.localeCompare(aValue);
            });
        }

        function renderPagination(totalPages) {
            pagination.innerHTML = '';

            const previousButton = document.createElement('button');
            previousButton.type = 'button';
            previousButton.textContent = '<';
            previousButton.disabled = currentPage === 1;
            previousButton.addEventListener('click', () => {
                currentPage -= 1;
                render();
            });
            pagination.appendChild(previousButton);

            for (let page = 1; page <= totalPages; page += 1) {
                const button = document.createElement('button');
                button.type = 'button';
                button.textContent = page;
                button.classList.toggle('active', page === currentPage);
                button.addEventListener('click', () => {
                    currentPage = page;
                    render();
                });
                pagination.appendChild(button);
            }

            const nextButton = document.createElement('button');
            nextButton.type = 'button';
            nextButton.textContent = '>';
            nextButton.disabled = currentPage === totalPages;
            nextButton.addEventListener('click', () => {
                currentPage += 1;
                render();
            });
            pagination.appendChild(nextButton);
        }

        function render() {
            const sortedRows = sortRows(allRows);
            const totalPages = Math.max(1, Math.ceil(sortedRows.length / pageSize));

            if (currentPage > totalPages) {
                currentPage = totalPages;
            }

            const start = (currentPage - 1) * pageSize;
            const pageRows = sortedRows.slice(start, start + pageSize);

            allRows.forEach(row => {
                row.style.display = 'none';
            });

            pageRows.forEach(row => {
                row.style.display = '';
                tbody.appendChild(row);
            });

            summary.textContent = `Showing ${start + 1}-${Math.min(start + pageSize, sortedRows.length)} of ${sortedRows.length} leaves`;
            renderPagination(totalPages);
        }

        table.querySelectorAll('[data-leave-sort-key]').forEach(button => {
            button.addEventListener('click', () => {
                const nextSortKey = button.dataset.leaveSortKey;

                if (sortKey === nextSortKey) {
                    sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
                } else {
                    sortKey = nextSortKey;
                    sortDirection = 'asc';
                }

                currentPage = 1;
                render();
            });
        });

        render();
    });
}

/**
 * Provides sorting and pagination for employee promotion tables
 */
function initPromotionTables() {
    const tablePanels = document.querySelectorAll('[data-promotion-table]');
    if (!tablePanels.length) return;

    tablePanels.forEach(panel => {
        const table = panel.querySelector('.employee-data-table');
        const tbody = table ? table.querySelector('tbody') : null;
        const summary = panel.querySelector('[data-promotion-table-summary]');
        const pagination = panel.querySelector('[data-promotion-pagination]');

        if (!table || !tbody || !summary || !pagination) return;

        const pageSize = 4;
        const allRows = Array.from(tbody.querySelectorAll('tr'));
        let currentPage = 1;
        let sortKey = '';
        let sortDirection = 'asc';

        function getRowValue(row, key) {
            return (row.dataset[key] || '').trim();
        }

        function sortRows(rows) {
            if (!sortKey) return rows;

            return [...rows].sort((a, b) => {
                const aValue = getRowValue(a, sortKey);
                const bValue = getRowValue(b, sortKey);

                if (sortKey === 'promotionDate') {
                    return sortDirection === 'asc'
                        ? new Date(aValue) - new Date(bValue)
                        : new Date(bValue) - new Date(aValue);
                }

                return sortDirection === 'asc'
                    ? aValue.localeCompare(bValue)
                    : bValue.localeCompare(aValue);
            });
        }

        function renderPagination(totalPages) {
            pagination.innerHTML = '';

            const previousButton = document.createElement('button');
            previousButton.type = 'button';
            previousButton.textContent = '<';
            previousButton.disabled = currentPage === 1;
            previousButton.addEventListener('click', () => {
                currentPage -= 1;
                render();
            });
            pagination.appendChild(previousButton);

            for (let page = 1; page <= totalPages; page += 1) {
                const button = document.createElement('button');
                button.type = 'button';
                button.textContent = page;
                button.classList.toggle('active', page === currentPage);
                button.addEventListener('click', () => {
                    currentPage = page;
                    render();
                });
                pagination.appendChild(button);
            }

            const nextButton = document.createElement('button');
            nextButton.type = 'button';
            nextButton.textContent = '>';
            nextButton.disabled = currentPage === totalPages;
            nextButton.addEventListener('click', () => {
                currentPage += 1;
                render();
            });
            pagination.appendChild(nextButton);
        }

        function render() {
            const sortedRows = sortRows(allRows);
            const totalPages = Math.max(1, Math.ceil(sortedRows.length / pageSize));

            if (currentPage > totalPages) {
                currentPage = totalPages;
            }

            const start = (currentPage - 1) * pageSize;
            const pageRows = sortedRows.slice(start, start + pageSize);

            allRows.forEach(row => {
                row.style.display = 'none';
            });

            pageRows.forEach(row => {
                row.style.display = '';
                tbody.appendChild(row);
            });

            summary.textContent = `Showing ${start + 1}-${Math.min(start + pageSize, sortedRows.length)} of ${sortedRows.length} promotions`;
            renderPagination(totalPages);
        }

        table.querySelectorAll('[data-promotion-sort-key]').forEach(button => {
            button.addEventListener('click', () => {
                const nextSortKey = button.dataset.promotionSortKey;

                if (sortKey === nextSortKey) {
                    sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
                } else {
                    sortKey = nextSortKey;
                    sortDirection = 'asc';
                }

                currentPage = 1;
                render();
            });
        });

        render();
    });
}

/**
 * Provides sorting and pagination for employee payroll tables
 */
function initPayrollTables() {
    const tablePanels = document.querySelectorAll('[data-payroll-table]');
    if (!tablePanels.length) return;

    tablePanels.forEach(panel => {
        const table = panel.querySelector('.employee-data-table');
        const tbody = table ? table.querySelector('tbody') : null;
        const summary = panel.querySelector('[data-payroll-table-summary]');
        const pagination = panel.querySelector('[data-payroll-pagination]');

        if (!table || !tbody || !summary || !pagination) return;

        const pageSize = 4;
        const allRows = Array.from(tbody.querySelectorAll('tr'));
        let currentPage = 1;
        let sortKey = '';
        let sortDirection = 'asc';

        function getRowValue(row, key) {
            return (row.dataset[key] || '').trim();
        }

        function sortRows(rows) {
            if (!sortKey) return rows;

            return [...rows].sort((a, b) => {
                const aValue = getRowValue(a, sortKey);
                const bValue = getRowValue(b, sortKey);

                if (sortKey === 'paymentDate') {
                    return sortDirection === 'asc'
                        ? new Date(aValue) - new Date(bValue)
                        : new Date(bValue) - new Date(aValue);
                }

                if (['baseSalary', 'bonuses', 'deductions', 'netPay'].includes(sortKey)) {
                    return sortDirection === 'asc'
                        ? Number(aValue) - Number(bValue)
                        : Number(bValue) - Number(aValue);
                }

                return sortDirection === 'asc'
                    ? aValue.localeCompare(bValue)
                    : bValue.localeCompare(aValue);
            });
        }

        function renderPagination(totalPages) {
            pagination.innerHTML = '';

            const previousButton = document.createElement('button');
            previousButton.type = 'button';
            previousButton.textContent = '<';
            previousButton.disabled = currentPage === 1;
            previousButton.addEventListener('click', () => {
                currentPage -= 1;
                render();
            });
            pagination.appendChild(previousButton);

            for (let page = 1; page <= totalPages; page += 1) {
                const button = document.createElement('button');
                button.type = 'button';
                button.textContent = page;
                button.classList.toggle('active', page === currentPage);
                button.addEventListener('click', () => {
                    currentPage = page;
                    render();
                });
                pagination.appendChild(button);
            }

            const nextButton = document.createElement('button');
            nextButton.type = 'button';
            nextButton.textContent = '>';
            nextButton.disabled = currentPage === totalPages;
            nextButton.addEventListener('click', () => {
                currentPage += 1;
                render();
            });
            pagination.appendChild(nextButton);
        }

        function render() {
            const sortedRows = sortRows(allRows);
            const totalPages = Math.max(1, Math.ceil(sortedRows.length / pageSize));

            if (currentPage > totalPages) {
                currentPage = totalPages;
            }

            const start = (currentPage - 1) * pageSize;
            const pageRows = sortedRows.slice(start, start + pageSize);

            allRows.forEach(row => {
                row.style.display = 'none';
            });

            pageRows.forEach(row => {
                row.style.display = '';
                tbody.appendChild(row);
            });

            summary.textContent = `Showing ${start + 1}-${Math.min(start + pageSize, sortedRows.length)} of ${sortedRows.length} payroll records`;
            renderPagination(totalPages);
        }

        table.querySelectorAll('[data-payroll-sort-key]').forEach(button => {
            button.addEventListener('click', () => {
                const nextSortKey = button.dataset.payrollSortKey;

                if (sortKey === nextSortKey) {
                    sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
                } else {
                    sortKey = nextSortKey;
                    sortDirection = 'asc';
                }

                currentPage = 1;
                render();
            });
        });

        render();
    });
}

/**
 * Provides sorting and pagination for employee training history tables
 */
function initTrainingTables() {
    const tablePanels = document.querySelectorAll('[data-training-table]');
    if (!tablePanels.length) return;

    tablePanels.forEach(panel => {
        const table = panel.querySelector('.employee-data-table');
        const tbody = table ? table.querySelector('tbody') : null;
        const summary = panel.querySelector('[data-training-table-summary]');
        const pagination = panel.querySelector('[data-training-pagination]');

        if (!table || !tbody || !summary || !pagination) return;

        const pageSize = 4;
        const allRows = Array.from(tbody.querySelectorAll('tr'));
        let currentPage = 1;
        let sortKey = '';
        let sortDirection = 'asc';

        function getRowValue(row, key) {
            return (row.dataset[key] || '').trim();
        }

        function sortRows(rows) {
            if (!sortKey) return rows;

            return [...rows].sort((a, b) => {
                const aValue = getRowValue(a, sortKey);
                const bValue = getRowValue(b, sortKey);

                if (sortKey === 'date') {
                    return sortDirection === 'asc'
                        ? new Date(aValue) - new Date(bValue)
                        : new Date(bValue) - new Date(aValue);
                }

                if (sortKey === 'score') {
                    return sortDirection === 'asc'
                        ? Number(aValue) - Number(bValue)
                        : Number(bValue) - Number(aValue);
                }

                return sortDirection === 'asc'
                    ? aValue.localeCompare(bValue)
                    : bValue.localeCompare(aValue);
            });
        }

        function renderPagination(totalPages) {
            pagination.innerHTML = '';

            const previousButton = document.createElement('button');
            previousButton.type = 'button';
            previousButton.textContent = '<';
            previousButton.disabled = currentPage === 1;
            previousButton.addEventListener('click', () => {
                currentPage -= 1;
                render();
            });
            pagination.appendChild(previousButton);

            for (let page = 1; page <= totalPages; page += 1) {
                const button = document.createElement('button');
                button.type = 'button';
                button.textContent = page;
                button.classList.toggle('active', page === currentPage);
                button.addEventListener('click', () => {
                    currentPage = page;
                    render();
                });
                pagination.appendChild(button);
            }

            const nextButton = document.createElement('button');
            nextButton.type = 'button';
            nextButton.textContent = '>';
            nextButton.disabled = currentPage === totalPages;
            nextButton.addEventListener('click', () => {
                currentPage += 1;
                render();
            });
            pagination.appendChild(nextButton);
        }

        function render() {
            const sortedRows = sortRows(allRows);
            const totalPages = Math.max(1, Math.ceil(sortedRows.length / pageSize));

            if (currentPage > totalPages) {
                currentPage = totalPages;
            }

            const start = (currentPage - 1) * pageSize;
            const pageRows = sortedRows.slice(start, start + pageSize);

            allRows.forEach(row => {
                row.style.display = 'none';
            });

            pageRows.forEach(row => {
                row.style.display = '';
                tbody.appendChild(row);
            });

            summary.textContent = `Showing ${start + 1}-${Math.min(start + pageSize, sortedRows.length)} of ${sortedRows.length} trainings`;
            renderPagination(totalPages);
        }

        table.querySelectorAll('[data-training-sort-key]').forEach(button => {
            button.addEventListener('click', () => {
                const nextSortKey = button.dataset.trainingSortKey;

                if (sortKey === nextSortKey) {
                    sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
                } else {
                    sortKey = nextSortKey;
                    sortDirection = 'asc';
                }

                currentPage = 1;
                render();
            });
        });

        render();
    });
}

/**
 * Provides sorting and pagination for employee pension contribution tables
 */
function initPensionTables() {
    const tablePanels = document.querySelectorAll('[data-pension-table]');
    if (!tablePanels.length) return;

    tablePanels.forEach(panel => {
        const table = panel.querySelector('.employee-data-table');
        const tbody = table ? table.querySelector('tbody') : null;
        const summary = panel.querySelector('[data-pension-table-summary]');
        const pagination = panel.querySelector('[data-pension-pagination]');

        if (!table || !tbody || !summary || !pagination) return;

        const pageSize = 4;
        const allRows = Array.from(tbody.querySelectorAll('tr'));
        let currentPage = 1;
        let sortKey = '';
        let sortDirection = 'asc';

        function getRowValue(row, key) {
            return (row.dataset[key] || '').trim();
        }

        function sortRows(rows) {
            if (!sortKey) return rows;

            return [...rows].sort((a, b) => {
                const aValue = getRowValue(a, sortKey);
                const bValue = getRowValue(b, sortKey);

                if (sortKey === 'contributionDate') {
                    return sortDirection === 'asc'
                        ? new Date(aValue) - new Date(bValue)
                        : new Date(bValue) - new Date(aValue);
                }

                if (['employeeShare', 'employerShare', 'total', 'fundBalance'].includes(sortKey)) {
                    return sortDirection === 'asc'
                        ? Number(aValue) - Number(bValue)
                        : Number(bValue) - Number(aValue);
                }

                return sortDirection === 'asc'
                    ? aValue.localeCompare(bValue)
                    : bValue.localeCompare(aValue);
            });
        }

        function renderPagination(totalPages) {
            pagination.innerHTML = '';

            const previousButton = document.createElement('button');
            previousButton.type = 'button';
            previousButton.textContent = '<';
            previousButton.disabled = currentPage === 1;
            previousButton.addEventListener('click', () => {
                currentPage -= 1;
                render();
            });
            pagination.appendChild(previousButton);

            for (let page = 1; page <= totalPages; page += 1) {
                const button = document.createElement('button');
                button.type = 'button';
                button.textContent = page;
                button.classList.toggle('active', page === currentPage);
                button.addEventListener('click', () => {
                    currentPage = page;
                    render();
                });
                pagination.appendChild(button);
            }

            const nextButton = document.createElement('button');
            nextButton.type = 'button';
            nextButton.textContent = '>';
            nextButton.disabled = currentPage === totalPages;
            nextButton.addEventListener('click', () => {
                currentPage += 1;
                render();
            });
            pagination.appendChild(nextButton);
        }

        function render() {
            const sortedRows = sortRows(allRows);
            const totalPages = Math.max(1, Math.ceil(sortedRows.length / pageSize));

            if (currentPage > totalPages) {
                currentPage = totalPages;
            }

            const start = (currentPage - 1) * pageSize;
            const pageRows = sortedRows.slice(start, start + pageSize);

            allRows.forEach(row => {
                row.style.display = 'none';
            });

            pageRows.forEach(row => {
                row.style.display = '';
                tbody.appendChild(row);
            });

            summary.textContent = `Showing ${start + 1}-${Math.min(start + pageSize, sortedRows.length)} of ${sortedRows.length} contributions`;
            renderPagination(totalPages);
        }

        table.querySelectorAll('[data-pension-sort-key]').forEach(button => {
            button.addEventListener('click', () => {
                const nextSortKey = button.dataset.pensionSortKey;

                if (sortKey === nextSortKey) {
                    sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
                } else {
                    sortKey = nextSortKey;
                    sortDirection = 'asc';
                }

                currentPage = 1;
                render();
            });
        });

        render();
    });
}

/**
 * Provides sorting and pagination for employee roster tables
 */
function initRosterTables() {
    const tablePanels = document.querySelectorAll('[data-roster-table]');
    if (!tablePanels.length) return;

    tablePanels.forEach(panel => {
        const table = panel.querySelector('.employee-data-table');
        const tbody = table ? table.querySelector('tbody') : null;
        const summary = panel.querySelector('[data-roster-table-summary]');
        const pagination = panel.querySelector('[data-roster-pagination]');

        if (!table || !tbody || !summary || !pagination) return;

        const pageSize = 5;
        const allRows = Array.from(tbody.querySelectorAll('tr'));
        let currentPage = 1;
        let sortKey = '';
        let sortDirection = 'asc';

        function getRowValue(row, key) {
            return (row.dataset[key] || '').trim();
        }

        function sortRows(rows) {
            if (!sortKey) return rows;

            return [...rows].sort((a, b) => {
                const aValue = getRowValue(a, sortKey);
                const bValue = getRowValue(b, sortKey);

                if (sortKey === 'day') {
                    return sortDirection === 'asc'
                        ? Number(aValue) - Number(bValue)
                        : Number(bValue) - Number(aValue);
                }

                return sortDirection === 'asc'
                    ? aValue.localeCompare(bValue)
                    : bValue.localeCompare(aValue);
            });
        }

        function renderPagination(totalPages) {
            pagination.innerHTML = '';

            const previousButton = document.createElement('button');
            previousButton.type = 'button';
            previousButton.textContent = '<';
            previousButton.disabled = currentPage === 1;
            previousButton.addEventListener('click', () => {
                currentPage -= 1;
                render();
            });
            pagination.appendChild(previousButton);

            for (let page = 1; page <= totalPages; page += 1) {
                const button = document.createElement('button');
                button.type = 'button';
                button.textContent = page;
                button.classList.toggle('active', page === currentPage);
                button.addEventListener('click', () => {
                    currentPage = page;
                    render();
                });
                pagination.appendChild(button);
            }

            const nextButton = document.createElement('button');
            nextButton.type = 'button';
            nextButton.textContent = '>';
            nextButton.disabled = currentPage === totalPages;
            nextButton.addEventListener('click', () => {
                currentPage += 1;
                render();
            });
            pagination.appendChild(nextButton);
        }

        function render() {
            const sortedRows = sortRows(allRows);
            const totalPages = Math.max(1, Math.ceil(sortedRows.length / pageSize));

            if (currentPage > totalPages) {
                currentPage = totalPages;
            }

            const start = (currentPage - 1) * pageSize;
            const pageRows = sortedRows.slice(start, start + pageSize);

            allRows.forEach(row => {
                row.style.display = 'none';
            });

            pageRows.forEach(row => {
                row.style.display = '';
                tbody.appendChild(row);
            });

            summary.textContent = `Showing ${start + 1}-${Math.min(start + pageSize, sortedRows.length)} of ${sortedRows.length} roster days`;
            renderPagination(totalPages);
        }

        table.querySelectorAll('[data-roster-sort-key]').forEach(button => {
            button.addEventListener('click', () => {
                const nextSortKey = button.dataset.rosterSortKey;

                if (sortKey === nextSortKey) {
                    sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
                } else {
                    sortKey = nextSortKey;
                    sortDirection = 'asc';
                }

                currentPage = 1;
                render();
            });
        });

        render();
    });
}

/**
 * Provides sorting and pagination for employee document tables
 */
function initDocumentTables() {
    const tablePanels = document.querySelectorAll('[data-document-table]');
    if (!tablePanels.length) return;

    tablePanels.forEach(panel => {
        const table = panel.querySelector('.employee-data-table');
        const tbody = table ? table.querySelector('tbody') : null;
        const summary = panel.querySelector('[data-document-table-summary]');
        const pagination = panel.querySelector('[data-document-pagination]');

        if (!table || !tbody || !summary || !pagination) return;

        const pageSize = 4;
        const allRows = Array.from(tbody.querySelectorAll('tr'));
        let currentPage = 1;
        let sortKey = '';
        let sortDirection = 'asc';

        function getRowValue(row, key) {
            return (row.dataset[key] || '').trim();
        }

        function sortRows(rows) {
            if (!sortKey) return rows;

            return [...rows].sort((a, b) => {
                const aValue = getRowValue(a, sortKey);
                const bValue = getRowValue(b, sortKey);

                if (sortKey === 'updated') {
                    return sortDirection === 'asc'
                        ? new Date(aValue) - new Date(bValue)
                        : new Date(bValue) - new Date(aValue);
                }

                return sortDirection === 'asc'
                    ? aValue.localeCompare(bValue)
                    : bValue.localeCompare(aValue);
            });
        }

        function renderPagination(totalPages) {
            pagination.innerHTML = '';

            const previousButton = document.createElement('button');
            previousButton.type = 'button';
            previousButton.textContent = '<';
            previousButton.disabled = currentPage === 1;
            previousButton.addEventListener('click', () => {
                currentPage -= 1;
                render();
            });
            pagination.appendChild(previousButton);

            for (let page = 1; page <= totalPages; page += 1) {
                const button = document.createElement('button');
                button.type = 'button';
                button.textContent = page;
                button.classList.toggle('active', page === currentPage);
                button.addEventListener('click', () => {
                    currentPage = page;
                    render();
                });
                pagination.appendChild(button);
            }

            const nextButton = document.createElement('button');
            nextButton.type = 'button';
            nextButton.textContent = '>';
            nextButton.disabled = currentPage === totalPages;
            nextButton.addEventListener('click', () => {
                currentPage += 1;
                render();
            });
            pagination.appendChild(nextButton);
        }

        function render() {
            const sortedRows = sortRows(allRows);
            const totalPages = Math.max(1, Math.ceil(sortedRows.length / pageSize));

            if (currentPage > totalPages) {
                currentPage = totalPages;
            }

            const start = (currentPage - 1) * pageSize;
            const pageRows = sortedRows.slice(start, start + pageSize);

            allRows.forEach(row => {
                row.style.display = 'none';
            });

            pageRows.forEach(row => {
                row.style.display = '';
                tbody.appendChild(row);
            });

            summary.textContent = `Showing ${start + 1}-${Math.min(start + pageSize, sortedRows.length)} of ${sortedRows.length} documents`;
            renderPagination(totalPages);
        }

        table.querySelectorAll('[data-document-sort-key]').forEach(button => {
            button.addEventListener('click', () => {
                const nextSortKey = button.dataset.documentSortKey;

                if (sortKey === nextSortKey) {
                    sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
                } else {
                    sortKey = nextSortKey;
                    sortDirection = 'asc';
                }

                currentPage = 1;
                render();
            });
        });

        render();
    });
}

/**
 * Generates sample document previews for employee documents
 */
function initDocumentPreview() {
    const modal = document.getElementById('document-preview-modal');
    const previewPage = modal ? modal.querySelector('[data-document-preview-page]') : null;
    const title = document.getElementById('document-preview-title');
    const subtitle = document.getElementById('document-preview-subtitle');
    const printButton = modal ? modal.querySelector('[data-document-print]') : null;
    const closeTriggers = modal ? modal.querySelectorAll('[data-hrm-modal-close]') : [];
    const previewButtons = document.querySelectorAll('[data-document-preview]');

    if (!modal || !previewPage || !title || !subtitle || !previewButtons.length) return;

    const employee = {
        name: modal.dataset.employeeName || '',
        id: modal.dataset.employeeId || '',
        role: modal.dataset.employeeRole || '',
        department: modal.dataset.employeeDepartment || '',
        branch: modal.dataset.employeeBranch || '',
        email: modal.dataset.employeeEmail || '',
        phone: modal.dataset.employeePhone || '',
        joinDate: modal.dataset.employeeJoinDate || '',
    };

    function escapeHtml(value) {
        return String(value)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function renderMeta(documentData) {
        return `
            <dl class="document-preview-meta">
                <div><dt>Employee</dt><dd>${escapeHtml(employee.name)}</dd></div>
                <div><dt>Employee ID</dt><dd>${escapeHtml(employee.id)}</dd></div>
                <div><dt>Department</dt><dd>${escapeHtml(employee.department)}</dd></div>
                <div><dt>Branch</dt><dd>${escapeHtml(employee.branch)}</dd></div>
                <div><dt>Document Status</dt><dd>${escapeHtml(documentData.status)}</dd></div>
                <div><dt>Updated</dt><dd>${escapeHtml(documentData.updated)}</dd></div>
            </dl>
        `;
    }

    function renderCertificate(documentData) {
        return `
            <div class="sample-certificate">
                <div class="document-preview-stamp">Verified</div>
                <p class="document-preview-kicker">${escapeHtml(documentData.category)} Record</p>
                <h3>Certificate of ${escapeHtml(documentData.document)}</h3>
                <p>This certifies that <strong>${escapeHtml(employee.name)}</strong>, employee number <strong>${escapeHtml(employee.id)}</strong>, has the above document recorded in the employee file.</p>
                <p>The document is attached to the <strong>${escapeHtml(employee.department)}</strong> department at <strong>${escapeHtml(employee.branch)}</strong>.</p>
                ${renderMeta(documentData)}
                <div class="document-signature-row">
                    <span>HR Office</span>
                    <span>Authorized Signature</span>
                </div>
            </div>
        `;
    }

    function renderIdentity(documentData) {
        return `
            <div class="sample-id-document">
                <div class="sample-id-card">
                    <div class="sample-id-avatar">${escapeHtml(employee.name.split(' ').map(part => part.charAt(0)).join('').slice(0, 2))}</div>
                    <div>
                        <p class="document-preview-kicker">${escapeHtml(documentData.document)}</p>
                        <h3>${escapeHtml(employee.name)}</h3>
                        <dl>
                            <div><dt>Employee ID</dt><dd>${escapeHtml(employee.id)}</dd></div>
                            <div><dt>Role</dt><dd>${escapeHtml(employee.role)}</dd></div>
                            <div><dt>Branch</dt><dd>${escapeHtml(employee.branch)}</dd></div>
                            <div><dt>Phone</dt><dd>${escapeHtml(employee.phone)}</dd></div>
                        </dl>
                    </div>
                </div>
                ${renderMeta(documentData)}
            </div>
        `;
    }

    function renderEmploymentDocument(documentData) {
        return `
            <div class="sample-employment-document">
                <p class="document-preview-kicker">${escapeHtml(documentData.category)} Document</p>
                <h3>${escapeHtml(documentData.document)}</h3>
                <p>This sample document records the employment relationship for <strong>${escapeHtml(employee.name)}</strong> as <strong>${escapeHtml(employee.role)}</strong>.</p>
                <dl class="document-preview-meta">
                    <div><dt>Start Date</dt><dd>${escapeHtml(employee.joinDate)}</dd></div>
                    <div><dt>Department</dt><dd>${escapeHtml(employee.department)}</dd></div>
                    <div><dt>Branch</dt><dd>${escapeHtml(employee.branch)}</dd></div>
                    <div><dt>Email</dt><dd>${escapeHtml(employee.email)}</dd></div>
                    <div><dt>Status</dt><dd>${escapeHtml(documentData.status)}</dd></div>
                    <div><dt>Last Updated</dt><dd>${escapeHtml(documentData.updated)}</dd></div>
                </dl>
                <div class="document-clause-list">
                    <p>1. Duties are assigned according to the employee's department and branch placement.</p>
                    <p>2. Employee records remain subject to HR verification and compliance review.</p>
                    <p>3. This preview is a sample generated from the selected employee profile.</p>
                </div>
                <div class="document-signature-row">
                    <span>${escapeHtml(employee.name)}</span>
                    <span>HR Office</span>
                </div>
            </div>
        `;
    }

    function renderGenericDocument(documentData) {
        return `
            <div class="sample-employment-document">
                <p class="document-preview-kicker">${escapeHtml(documentData.type)}</p>
                <h3>${escapeHtml(documentData.document)}</h3>
                <p>This is a sample employee file document generated for <strong>${escapeHtml(employee.name)}</strong>.</p>
                ${renderMeta(documentData)}
            </div>
        `;
    }

    function renderDocument(documentData) {
        if (documentData.type === 'Identity Doc') {
            return renderIdentity(documentData);
        }

        if (documentData.document.toLowerCase().includes('contract')) {
            return renderEmploymentDocument(documentData);
        }

        if (documentData.type === 'Qualification' || documentData.type === 'Certificate') {
            return renderCertificate(documentData);
        }

        return renderGenericDocument(documentData);
    }

    function openModal(documentData) {
        title.textContent = documentData.document;
        subtitle.textContent = `${documentData.type} · ${documentData.category}`;
        previewPage.innerHTML = renderDocument(documentData);
        modal.classList.add('open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('hrm-modal-open');
    }

    function closeModal() {
        modal.classList.remove('open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('hrm-modal-open');
    }

    previewButtons.forEach(button => {
        button.addEventListener('click', () => {
            const row = button.closest('tr');
            if (!row) return;

            openModal({
                type: row.dataset.type || '',
                document: row.dataset.document || '',
                category: row.dataset.category || '',
                status: row.dataset.status || '',
                updated: row.dataset.updated || '',
            });
        });
    });

    if (printButton) {
        printButton.addEventListener('click', () => {
            window.print();
        });
    }

    closeTriggers.forEach(trigger => {
        trigger.addEventListener('click', closeModal);
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal.classList.contains('open')) {
            closeModal();
        }
    });
}
