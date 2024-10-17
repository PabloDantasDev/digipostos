<?php

use App\Http\Controllers\authentications\AuthenticationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\layouts\Fluid;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\authentications\UpdateUserController;
use App\Http\Controllers\CadastroPostosController;
use App\Http\Controllers\CadastrosController;
use App\Http\Controllers\cards\CardBasic;
use App\Http\Controllers\CombustivelController;
use App\Http\Controllers\CreditoController;
use App\Http\Controllers\user_interface\Accordion;
use App\Http\Controllers\user_interface\Alerts;
use App\Http\Controllers\user_interface\Badges;
use App\Http\Controllers\user_interface\Buttons;
use App\Http\Controllers\user_interface\Carousel;
use App\Http\Controllers\user_interface\Collapse;
use App\Http\Controllers\user_interface\Dropdowns;
use App\Http\Controllers\user_interface\Footer;
use App\Http\Controllers\user_interface\ListGroups;
use App\Http\Controllers\user_interface\Modals;
use App\Http\Controllers\user_interface\Navbar;
use App\Http\Controllers\user_interface\Offcanvas;
use App\Http\Controllers\user_interface\PaginationBreadcrumbs;
use App\Http\Controllers\user_interface\Progress;
use App\Http\Controllers\user_interface\Spinners;
use App\Http\Controllers\user_interface\TabsPills;
use App\Http\Controllers\user_interface\Toasts;
use App\Http\Controllers\user_interface\TooltipsPopovers;
use App\Http\Controllers\user_interface\Typography;
use App\Http\Controllers\extended_ui\PerfectScrollbar;
use App\Http\Controllers\extended_ui\TextDivider;
use App\Http\Controllers\icons\Boxicons;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\form_layouts\HorizontalForm;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostoController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\tables\Basic as TablesBasic;
use App\Http\Middleware\IsAdmin;

// layout
Route::get('/layouts/without-menu', [WithoutMenu::class, 'index'])->name('layouts-without-menu');
Route::get('/layouts/without-navbar', [WithoutNavbar::class, 'index'])->name('layouts-without-navbar');
Route::get('/layouts/fluid', [Fluid::class, 'index'])->name('layouts-fluid');
Route::get('/layouts/container', [Container::class, 'index'])->name('layouts-container');
Route::get('/layouts/blank', [Blank::class, 'index'])->name('layouts-blank');

// pages
Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name('pages-account-settings-account');
Route::get('/pages/account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name('pages-account-settings-notifications');
Route::get('/pages/account-settings-connections', [AccountSettingsConnections::class, 'index'])->name('pages-account-settings-connections');
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
Route::get('/pages/misc-under-maintenance', [MiscUnderMaintenance::class, 'index'])->name('pages-misc-under-maintenance');

// cards
Route::get('/cards/basic', [CardBasic::class, 'index'])->name('cards-basic');

// User Interface
Route::get('/ui/accordion', [Accordion::class, 'index'])->name('ui-accordion');
Route::get('/ui/alerts', [Alerts::class, 'index'])->name('ui-alerts');
Route::get('/ui/badges', [Badges::class, 'index'])->name('ui-badges');
Route::get('/ui/buttons', [Buttons::class, 'index'])->name('ui-buttons');
Route::get('/ui/carousel', [Carousel::class, 'index'])->name('ui-carousel');
Route::get('/ui/collapse', [Collapse::class, 'index'])->name('ui-collapse');
Route::get('/ui/dropdowns', [Dropdowns::class, 'index'])->name('ui-dropdowns');
Route::get('/ui/footer', [Footer::class, 'index'])->name('ui-footer');
Route::get('/ui/list-groups', [ListGroups::class, 'index'])->name('ui-list-groups');
Route::get('/ui/modals', [Modals::class, 'index'])->name('ui-modals');
Route::get('/ui/navbar', [Navbar::class, 'index'])->name('ui-navbar');
Route::get('/ui/offcanvas', [Offcanvas::class, 'index'])->name('ui-offcanvas');
Route::get('/ui/pagination-breadcrumbs', [PaginationBreadcrumbs::class, 'index'])->name('ui-pagination-breadcrumbs');
Route::get('/ui/progress', [Progress::class, 'index'])->name('ui-progress');
Route::get('/ui/spinners', [Spinners::class, 'index'])->name('ui-spinners');
Route::get('/ui/tabs-pills', [TabsPills::class, 'index'])->name('ui-tabs-pills');
Route::get('/ui/toasts', [Toasts::class, 'index'])->name('ui-toasts');
Route::get('/ui/tooltips-popovers', [TooltipsPopovers::class, 'index'])->name('ui-tooltips-popovers');
Route::get('/ui/typography', [Typography::class, 'index'])->name('ui-typography');

// extended ui
Route::get('/extended/ui-perfect-scrollbar', [PerfectScrollbar::class, 'index'])->name('extended-ui-perfect-scrollbar');
Route::get('/extended/ui-text-divider', [TextDivider::class, 'index'])->name('extended-ui-text-divider');

// icons
Route::get('/icons/boxicons', [Boxicons::class, 'index'])->name('icons-boxicons');

// form elements
Route::get('/forms/basic-inputs', [BasicInput::class, 'index'])->name('forms-basic-inputs');
Route::get('/forms/input-groups', [InputGroups::class, 'index'])->name('forms-input-groups');

// form layouts
Route::get('/form/layouts-vertical', [VerticalForm::class, 'index'])->name('form-layouts-vertical');
Route::get('/form/layouts-horizontal', [HorizontalForm::class, 'index'])->name('form-layouts-horizontal');

// tables
Route::get('/tables/basic', [TablesBasic::class, 'index'])->name('tables-basic');

// Main Page Route
Route::get('/', [HomeController::class, 'index'])->name('home-page')->middleware('auth', 'isFunc');
Route::get('/frentista/{credId?}', [PostoController::class, 'index'])->name('home-frentista')->middleware('auth', 'isntFunc');

// prefeituras
Route::get('/cadastro/prefeituras', [CadastrosController::class, 'index'])->name('cadastros.prefeituras')->middleware('auth', 'isAdmin');
Route::get('/cadastro/secretarias/{prefeituraId?}', [CadastrosController::class, 'secretarias'])->name('cadastros.secretarias')->middleware('auth', 'isAdmin');
Route::get('/cadastro/veiculos/{secretariaId?}', [CadastrosController::class, 'veiculos'])->name('cadastros.veiculos')->middleware('auth', 'isAdmin');
Route::get('/cadastro/servidores/{secretariaId?}', [CadastrosController::class, 'servidores'])->name('cadastros.servidores')->middleware('auth', 'isAdmin');

// postos
Route::get('/cadastro/postos/postos', [CadastroPostosController::class, 'index'])->name('cadastro-postos.postos')->middleware('auth', 'isAdmin');
Route::get('/cadastro/postos/funcionarios/{postoId?}', [CadastroPostosController::class, 'funcionarios'])->name('cadastro-postos.funcionarios')->middleware('auth', 'isAdmin');

//Combustível
Route::get('/cadastro/postos/combustiveis', [CombustivelController::class, 'index'])->name('cadastro-postos.combustiveis')->middleware('auth', 'isAdmin');

// creditos
Route::get('/cadastro/creditos', [CreditoController::class, 'index'])->name('creditos')->middleware('auth', 'isAdmin');
Route::get('/qrcode/{credId}', [CreditoController::class, 'generateQrCode'])->name('qrcode')->middleware('auth', 'isAdmin');

// relatórios
Route::get('/relatorios/baixas', [RelatorioController::class, 'baixas'])->name('baixas')->middleware('auth', 'isAdmin');
Route::post('/relatorio/print', [RelatorioController::class, 'print'])->name('print')->middleware('auth', 'isAdmin');

// authentication
Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic')->middleware('auth', 'isAdmin');
Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');

// Authentications
Route::post('/auth/register', [AuthenticationController::class, 'register'])->name('auth.register')->middleware('auth', 'isAdmin');
Route::post('/auth/login', [AuthenticationController::class, 'login'])->name('auth.login');
Route::get('/auth/logout', [AuthenticationController::class, 'logout'])->name('auth.logout');
Route::get('/debitado', [FuncionarioController::class, 'index'])->name('confirm-debit');

//User
Route::post('/auth/user', [UpdateUserController::class, 'update'])->name('user.update');
Route::get('/auth/edit', [UpdateUserController::class, 'updateView'])->name('auth.user.update');
