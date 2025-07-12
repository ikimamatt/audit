# Struktur Direktori Aplikasi Audit

## 📁 Struktur Direktori yang Baru

### 🎯 **Controllers**
```
app/Http/Controllers/
├── Auth/                    # Authentication controllers
├── MasterData/             # Master data controllers
│   ├── MasterKodeRiskController.php
│   ├── MasterAuditeeController.php
│   ├── MasterUserController.php
│   └── MasterAksesUserController.php
├── Audit/                  # Audit module controllers
│   └── PerencanaanAuditController.php
└── Controller.php          # Base controller
```

### 🗃️ **Models**
```
app/Models/
├── MasterData/             # Master data models
│   ├── MasterKodeRisk.php
│   ├── MasterAuditee.php
│   ├── MasterUser.php
│   └── MasterAksesUser.php
├── Audit/                  # Audit module models
│   └── PerencanaanAudit.php
└── User.php               # Laravel default user model
```

### 🎨 **Views**
```
resources/views/
├── master-data/           # Master data views
│   ├── kode-risk/
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   └── edit.blade.php
│   ├── auditee/
│   ├── user/
│   └── akses-user/
├── audit/                 # Audit module views
│   └── perencanaan/
│       ├── index.blade.php
│       ├── create.blade.php
│       └── edit.blade.php
└── layouts/              # Layout templates
```

### 🛣️ **Routes**
```
routes/
├── web.php               # Main routes file
├── auth.php              # Authentication routes
├── master-data.php       # Master data routes
└── audit.php            # Audit module routes
```

## 🔗 **URL Structure**

### Master Data
- `/master/kode-risk` - Kode Risk management
- `/master/auditee` - Auditee management  
- `/master/user` - User management
- `/master/akses-user` - User access management

### Audit Module
- `/audit/perencanaan` - Audit planning management

## 📋 **Route Names**

### Master Data Routes
- `master.kode-risk.index` - List kode risk
- `master.kode-risk.create` - Create kode risk form
- `master.kode-risk.store` - Store kode risk
- `master.kode-risk.edit` - Edit kode risk form
- `master.kode-risk.update` - Update kode risk
- `master.kode-risk.destroy` - Delete kode risk

### Audit Routes
- `audit.perencanaan.index` - List audit plans
- `audit.perencanaan.create` - Create audit plan form
- `audit.perencanaan.store` - Store audit plan
- `audit.perencanaan.edit` - Edit audit plan form
- `audit.perencanaan.update` - Update audit plan
- `audit.perencanaan.destroy` - Delete audit plan

## 🚀 **Keuntungan Struktur Baru**

### ✅ **Modular**
- Setiap modul terpisah dan independen
- Mudah untuk menambah modul baru
- Maintenance yang lebih mudah

### ✅ **Scalable**
- Struktur yang mendukung pertumbuhan aplikasi
- Mudah untuk menambah fitur baru
- Organisasi kode yang lebih baik

### ✅ **Maintainable**
- Kode terorganisir dengan baik
- Mudah untuk debugging
- Dokumentasi yang jelas

### ✅ **Team Development**
- Multiple developer bisa bekerja parallel
- Konflik git yang minimal
- Code review yang lebih mudah

## 🔧 **Cara Menambah Modul Baru**

### 1. Buat Controller
```php
// app/Http/Controllers/NewModule/NewController.php
namespace App\Http\Controllers\NewModule;

class NewController extends Controller
{
    // CRUD methods
}
```

### 2. Buat Model
```php
// app/Models/NewModule/NewModel.php
namespace App\Models\NewModule;

class NewModel extends Model
{
    // Model properties
}
```

### 3. Buat Views
```
resources/views/new-module/
├── index.blade.php
├── create.blade.php
└── edit.blade.php
```

### 4. Buat Routes
```php
// routes/new-module.php
Route::prefix('new-module')->name('new-module.')->group(function () {
    Route::resource('items', NewController::class);
});
```

### 5. Include Routes
```php
// routes/web.php
require __DIR__ . '/new-module.php';
```

## 📝 **Best Practices**

1. **Naming Convention**
   - Controller: `PascalCase` + `Controller`
   - Model: `PascalCase`
   - View: `kebab-case`
   - Route: `kebab-case`

2. **Namespace**
   - Gunakan namespace yang sesuai dengan struktur direktori
   - Import model dengan namespace yang benar

3. **File Organization**
   - Satu controller per file
   - Satu model per file
   - Group related views dalam folder

4. **Route Organization**
   - Gunakan resource routes untuk CRUD
   - Prefix routes dengan nama modul
   - Name routes dengan prefix modul 