<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TrainSys — Manajemen Training & {{ __("dashboard.cert_list") }}</title>
<style>
  :root{
    --bg:#f6f8f9;
    --card:#ffffff;
    --border:#e6eaec;
    --text:#1a2b2a;
    --muted:#6b7c7b;
    --teal:#0d9488;
    --teal-dark:#0b7a70;
    --teal-soft:#e6f5f3;
    --green:#16a34a;
    --green-soft:#e9f9ef;
    --amber:#b45309;
    --amber-soft:#fef3e0;
    --red:#dc2626;
    --red-soft:#fdecec;
    --radius:12px;
    --shadow: 0 1px 2px rgba(16,24,24,0.04), 0 1px 12px rgba(16,24,24,0.04);
  }
  *{box-sizing:border-box;}
  body{
    margin:0;
    font-family:'Segoe UI', system-ui, -apple-system, sans-serif;
    background:var(--bg);
    color:var(--text);
  }

  /* ---------- Topbar ---------- */
  .topbar{
    display:flex;align-items:center;justify-content:space-between;
    background:var(--card);
    border-bottom:1px solid var(--border);
    padding:12px 24px;
    position:sticky;top:0;z-index:20;
  }
  .brand{display:flex;align-items:center;gap:10px;font-weight:700;font-size:17px;}
  .brand .logo{
    width:34px;height:34px;border-radius:9px;
    background:linear-gradient(135deg,var(--teal),var(--teal-dark));
    display:flex;align-items:center;justify-content:center;color:#fff;
    font-size:12.5px;font-weight:700;letter-spacing:-0.3px;
  }
  .brand .sub{font-weight:400;font-size:12px;color:var(--muted);display:block;margin-top:1px;}

  .tabs{display:flex;gap:4px;background:var(--bg);padding:4px;border-radius:10px;}
  .tab-btn{
    border:none;background:transparent;padding:8px 16px;border-radius:8px;
    font-size:13.5px;font-weight:600;color:var(--muted);cursor:pointer;
    transition:all .15s ease;
  }
  .tab-btn.active{background:var(--card);color:var(--teal-dark);box-shadow:var(--shadow);}
  .tab-btn:hover:not(.active){color:var(--text);}

  .user-box{display:flex;align-items:center;gap:12px;font-size:13.5px;color:var(--muted);}
  .avatar{width:30px;height:30px;border-radius:50%;background:var(--teal-soft);color:var(--teal-dark);
    display:flex;align-items:center;justify-content:center;font-weight:700;font-size:12px;}
  .logout-btn{
    border:1px solid var(--border);background:#fff;color:#b91c1c;padding:7px 14px;
    border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;
  }

  main{max-width:1280px;margin:0 auto;padding:24px;}

  .page-head{display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:18px;}
  .page-head h1{font-size:20px;margin:0 0 4px;}
  .page-head p{margin:0;color:var(--muted);font-size:13.5px;}

  /* ---------- Stat cards ---------- */
  .stats{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:20px;}
  .stat-card{
    background:var(--card);border:1px solid var(--border);border-radius:var(--radius);
    padding:16px 18px;box-shadow:var(--shadow);display:flex;flex-direction:column;gap:6px;
  }
  .stat-card .icon{
    width:34px;height:34px;border-radius:9px;display:flex;align-items:center;justify-content:center;
    font-size:16px;margin-bottom:4px;
  }
  .stat-card .label{font-size:12px;color:var(--muted);font-weight:600;letter-spacing:.2px;text-transform:uppercase;}
  .stat-card .value{font-size:24px;font-weight:700;}
  .stat-card .hint{font-size:12px;color:var(--muted);}
  .icon.teal{background:var(--teal-soft);color:var(--teal-dark);}
  .icon.green{background:var(--green-soft);color:var(--green);}
  .icon.amber{background:var(--amber-soft);color:var(--amber);}
  .icon.red{background:var(--red-soft);color:var(--red);}

  /* ---------- Panel ---------- */
  .panel{
    background:var(--card);border:1px solid var(--border);border-radius:var(--radius);
    box-shadow:var(--shadow); margin-bottom:20px; overflow:hidden;
  }
  .panel-head{
    display:flex;justify-content:space-between;align-items:center;gap:12px;
    padding:16px 18px;border-bottom:1px solid var(--border);flex-wrap:wrap;
  }
  .panel-head h2{font-size:15px;margin:0;}
  .panel-head .desc{font-size:12px;color:var(--muted);margin-top:2px;}
  .panel-actions{display:flex;gap:8px;align-items:center;}
  .search-box{
    border:1px solid var(--border);border-radius:8px;padding:7px 12px;font-size:13px;
    width:200px;background:#fbfcfc;
  }
  .btn-primary{
    background:var(--teal);color:#fff;border:none;padding:8px 16px;border-radius:8px;
    font-size:13.5px;font-weight:600;cursor:pointer;display:flex;align-items:center;gap:6px;
  }
  .btn-primary:hover{background:var(--teal-dark);}
  .btn-ghost{
    background:transparent;border:1px solid var(--border);color:var(--text);
    padding:8px 14px;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;
  }

  /* ---------- Scrollable table ---------- */
  .table-scroll{
    max-height:340px;
    overflow-y:auto;
  }
  .table-scroll::-webkit-scrollbar{width:8px;}
  .table-scroll::-webkit-scrollbar-thumb{background:#d7dedd;border-radius:8px;}
  .table-scroll::-webkit-scrollbar-thumb:hover{background:#b9c3c1;}

  table{width:100%;border-collapse:collapse;font-size:13.5px;}
  thead th{
    position:sticky;top:0;background:#fafcfc;
    text-align:left;padding:10px 18px;color:var(--muted);font-weight:600;font-size:12px;
    text-transform:uppercase;letter-spacing:.3px;border-bottom:1px solid var(--border);z-index:5;
  }
  tbody td{padding:12px 18px;border-bottom:1px solid #f0f2f2;}
  tbody tr:last-child td{border-bottom:none;}
  tbody tr:hover{background:#fafcfc;}
  .name-cell strong{display:block;}
  .name-cell span{color:var(--muted);font-size:12px;}

  .badge{
    display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:999px;
    font-size:11.5px;font-weight:700;
  }
  .badge.green{background:var(--green-soft);color:var(--green);}
  .badge.amber{background:var(--amber-soft);color:var(--amber);}
  .badge.red{background:var(--red-soft);color:var(--red);}
  .badge.gray{background:#eef1f1;color:var(--muted);}

  .row-actions{display:flex;gap:6px;}
  .icon-btn{
    border:1px solid var(--border);background:#fff;width:28px;height:28px;border-radius:7px;
    cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:13px;color:var(--muted);
  }
  .icon-btn:hover{border-color:var(--teal);color:var(--teal-dark);}
  .icon-btn.danger:hover{border-color:var(--red);color:var(--red);}

  .empty-row td{text-align:center;color:var(--muted);padding:28px;font-size:13px;}

  /* ---------- Modal ---------- */
  .modal-overlay{
    position:fixed;inset:0;background:rgba(15,25,24,0.45);
    display:none;align-items:center;justify-content:center;z-index:100;padding:20px;
  }
  .modal-overlay.show{display:flex;}
  .modal{
    background:#fff;border-radius:14px;width:100%;max-width:480px;
    box-shadow:0 20px 60px rgba(0,0,0,0.25);max-height:88vh;display:flex;flex-direction:column;
    animation:pop .15s ease;
  }
  @keyframes pop{from{transform:scale(.97);opacity:0;}to{transform:scale(1);opacity:1;}}
  .modal-head{display:flex;justify-content:space-between;align-items:center;padding:16px 20px;border-bottom:1px solid var(--border);}
  .modal-head h3{margin:0;font-size:15.5px;}
  .modal-close{border:none;background:transparent;font-size:18px;cursor:pointer;color:var(--muted);}
  .modal-body{padding:18px 20px;overflow-y:auto;}
  .form-group{margin-bottom:14px;}
  .form-group label{display:block;font-size:12.5px;font-weight:600;color:var(--muted);margin-bottom:5px;}
  .form-group input,.form-group select,.form-group textarea{
    width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:8px;font-size:13.5px;
    font-family:inherit;color:var(--text);background:#fbfcfc;
  }
  .form-row{display:grid;grid-template-columns:1fr 1fr;gap:12px;}
  .modal-foot{display:flex;justify-content:flex-end;gap:8px;padding:14px 20px;border-top:1px solid var(--border);}

  @media(max-width:900px){
    .stats{grid-template-columns:repeat(2,1fr);}
    .tabs{display:none;}
  }
</style>
</head>
<body>

<div class="topbar">
  <div class="brand">
    <div class="logo">TS</div>
    <div>BTZ HR System<span class="sub">Manajemen Training &amp; {{ __("dashboard.cert_list") }}</span></div>
  </div>
  
    <div class="tabs">
    <button class="tab-btn active" data-tab="training" onclick="switchTab('training')">{{ __('dashboard.tab_training') }}</button>
    <button class="tab-btn" data-tab="certs" onclick="switchTab('certs')">{{ __('dashboard.tab_certs') }}</button>
  </div>
  <div class="user-box" style="flex-direction: column; align-items: flex-end; gap: 4px;">
    <div style="display:flex; align-items:center; gap:12px;">
        <div class="avatar">HR</div>
        <span>Admin HR</span>
        <button class="logout-btn">Logout</button>
    </div>
    <div class="lang-switcher" style="display:flex; gap: 10px; margin-top: 8px;">
        <a href="{{ url('id/dashboard') }}" style="background:#eef1f1; padding:6px 12px; border-radius:6px; text-decoration:none; color:#333; font-size:12px; font-weight:600; border: 1px solid #dcdcdc;">IDN</a>
        <a href="{{ url('ja/dashboard') }}" style="background:#eef1f1; padding:6px 12px; border-radius:6px; text-decoration:none; color:#333; font-size:12px; font-weight:600; border: 1px solid #dcdcdc;">JP</a>
    </div>
  </div>
</div>

<main>
  <div class="page-head">
    <div>
      <h1>{{ __("dashboard.title") }}</h1>
      <p>{{ __("dashboard.period") }}</p>
    </div>
  </div>

  <div class="stats">
    <div class="stat-card">
      <div class="icon teal"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg></div>
      <div class="label">{{ __("dashboard.training_active") }}</div>
      <div class="value" id="statTraining">6</div>
      <div class="hint">{{ __("dashboard.running_this_month") }}</div>
    </div>
    <div class="stat-card">
      <div class="icon green"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
      <div class="label">{{ __("dashboard.participants") }}</div>
      <div class="value" id="statPeserta">34</div>
      <div class="hint">{{ __("dashboard.from_5_depts") }}</div>
    </div>
    <div class="stat-card">
      <div class="icon green"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg></div>
      <div class="label">{{ __("dashboard.cert_active") }}</div>
      <div class="value" id="statCertActive">21</div>
      <div class="hint">{{ __("dashboard.still_valid") }}</div>
    </div>
    <div class="stat-card">
      <div class="icon amber"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg></div>
      <div class="label">{{ __("dashboard.cert_expiring") }}</div>
      <div class="value" id="statCertExpiring">3</div>
      <div class="hint">{{ __("dashboard.in_30_days") }}</div>
    </div>
  </div>

  <!-- ================= TRAINING PANEL ================= -->
  <section class="panel" id="panel-training">
    <div class="panel-head">
      <div>
        <h2>{{ __("dashboard.training_list") }}</h2>
        <div class="desc">{{ __("dashboard.training_desc") }}</div>
      </div>
      <div class="panel-actions">
        <input class="search-box" placeholder="Cari training..." oninput="filterTable('trainingTable', this.value)">
        <button class="btn-primary" onclick="openTrainingModal()">{{ __("dashboard.add_training") }}</button>
      </div>
    </div>
    <div class="table-scroll">
      <table id="trainingTable">
        <thead>
          <tr>
            <th>{{ __("dashboard.th_training") }}</th>
            <th>{{ __("dashboard.th_category") }}</th>
            <th>{{ __("dashboard.th_organizer") }}</th>
            <th>{{ __("dashboard.th_schedule") }}</th>
            <th>{{ __("dashboard.th_participants") }}</th>
            <th>{{ __("dashboard.th_status") }}</th>
            <th style="text-align:right;">{{ __("dashboard.th_action") }}</th>
          </tr>
        </thead>
        <tbody id="trainingBody"><!-- rows injected by JS --></tbody>
      </table>
    </div>
  </section>

  <!-- ================= CERTIFICATE PANEL ================= -->
  <section class="panel" id="panel-certs" style="display:none;">
    <div class="panel-head">
      <div>
        <h2>{{ __("dashboard.cert_list") }}</h2>
        <div class="desc">{{ __("dashboard.cert_desc") }}</div>
      </div>
      <div class="panel-actions">
        <input class="search-box" placeholder="Cari karyawan..." oninput="filterTable('certTable', this.value)">
        <button class="btn-primary" onclick="openCertModal()">{{ __("dashboard.upload_cert") }}</button>
      </div>
    </div>
    <div class="table-scroll">
      <table id="certTable">
        <thead>
          <tr>
            <th>{{ __("dashboard.th_employee") }}</th>
            <th>{{ __("dashboard.th_training") }}</th>
            <th>{{ __("dashboard.th_issued") }}</th>
            <th>{{ __("dashboard.th_valid_until") }}</th>
            <th>{{ __("dashboard.th_status") }}</th>
            <th style="text-align:right;">{{ __("dashboard.th_action") }}</th>
          </tr>
        </thead>
        <tbody id="certBody"></tbody>
      </table>
    </div>
  </section>
</main>

<!-- ================= MODAL: TRAINING ================= -->
<div class="modal-overlay" id="trainingModalOverlay">
  <div class="modal">
    <div class="modal-head">
      <h3 id="trainingModalTitle">{{ __("dashboard.modal_add_training") }}</h3>
      <button class="modal-close" onclick="closeModal('trainingModalOverlay')">✕</button>
    </div>
    <div class="modal-body">
      <div class="form-group">
        <label>{{ __("dashboard.lbl_training_name") }}</label>
        <input type="text" id="f_title" placeholder="{{ __("dashboard.ph_training_name") }}">
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>{{ __("dashboard.lbl_category") }}</label>
          <select id="f_category">
            <option>{{ __("dashboard.cat_teknis") }}</option>
            <option>{{ __('dashboard.cat_soft_skill') }}</option>
            <option>{{ __('dashboard.cat_k3') }}</option>
            <option>{{ __('dashboard.cat_cert_prof') }}</option>
          </select>
        </div>
        <div class="form-group">
          <label>{{ __("dashboard.lbl_organizer") }}</label>
          <input type="text" id="f_organizer" placeholder="{{ __("dashboard.ph_organizer") }}">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>{{ __("dashboard.lbl_start_date") }}</label>
          <input type="date" id="f_start">
        </div>
        <div class="form-group">
          <label>{{ __("dashboard.lbl_end_date") }}</label>
          <input type="date" id="f_end">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>{{ __("dashboard.lbl_location") }}</label>
          <input type="text" id="f_location" placeholder="{{ __("dashboard.ph_location") }}">
        </div>
        <div class="form-group">
          <label>{{ __("dashboard.lbl_quota") }}</label>
          <input type="number" id="f_quota" placeholder="{{ __("dashboard.ph_quota") }}">
        </div>
      </div>
    </div>
    <div class="modal-foot">
      <button class="btn-ghost" onclick="closeModal('trainingModalOverlay')">{{ __("dashboard.btn_cancel") }}</button>
      <button class="btn-primary" onclick="saveTraining()">{{ __("dashboard.btn_save") }}</button>
    </div>
  </div>
</div>

<!-- ================= MODAL: CERTIFICATE ================= -->
<div class="modal-overlay" id="certModalOverlay">
  <div class="modal">
    <div class="modal-head">
      <h3 id="certModalTitle">{{ __("dashboard.modal_upload_cert") }}</h3>
      <button class="modal-close" onclick="closeModal('certModalOverlay')">✕</button>
    </div>
    <div class="modal-body">
      <div class="form-group">
        <label>{{ __("dashboard.lbl_employee") }}</label>
        <select id="c_employee">
          <option>{{ __("dashboard.employee_rina") }}</option>
          <option>{{ __("dashboard.employee_dimas") }}</option>
          <option>{{ __("dashboard.employee_siti") }}</option>
          <option>{{ __("dashboard.employee_budi") }}</option>
        </select>
      </div>
      <div class="form-group">
        <label>{{ __("dashboard.lbl_related_training") }}</label>
        <select id="c_training">
          <option>{{ __('dashboard.title_k3') }}</option>
          <option>{{ __('dashboard.title_leadership') }}</option>
          <option>{{ __('dashboard.title_iso') }}</option>
        </select>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>{{ __("dashboard.lbl_issue_date") }}</label>
          <input type="date" id="c_issued">
        </div>
        <div class="form-group">
          <label>{{ __("dashboard.lbl_valid_until") }}</label>
          <input type="date" id="c_expiry">
        </div>
      </div>
      <div class="form-group">
        <label>{{ __("dashboard.lbl_cert_file") }}</label>
        <input type="file" id="c_file">
      </div>
    </div>
    <div class="modal-foot">
      <button class="btn-ghost" onclick="closeModal('certModalOverlay')">{{ __("dashboard.btn_cancel") }}</button>
      <button class="btn-primary" onclick="saveCert()">{{ __("dashboard.btn_save") }}</button>
    </div>
  </div>
</div>


<!-- ================= MODAL: DELETE CONFIRM ================= -->
<div class="modal-overlay" id="deleteModalOverlay">
  <div class="modal" style="max-width: 380px;">
    <div class="modal-head">
      <h3 id="deleteModalTitle">{{ __("dashboard.modal_delete_title") }}</h3>
      <button class="modal-close" onclick="closeModal('deleteModalOverlay')">✕</button>
    </div>
    <div class="modal-body">
      <p id="deleteModalBody" style="font-size: 13.5px; margin: 0;"></p>
    </div>
    <div class="modal-foot">
      <button class="btn-ghost" onclick="closeModal('deleteModalOverlay')">{{ __("dashboard.btn_cancel") }}</button>
      <button class="btn-primary" style="background: var(--red); color: white;" id="btnConfirmDelete" onclick="executeDelete()">{{ __("dashboard.btn_delete") }}</button>
    </div>
  </div>
</div>
<script>
// ---------- Dummy in-memory data (nanti diganti fetch ke Laravel API) ----------
let trainings = [
  {title:"{{ __('dashboard.title_k3') }}", category:"{{ __('dashboard.cat_k3') }}", organizer:"Vendor SafeWork", start:"2026-02-10", end:"2026-02-11", participants:12, quota:15, status:"{{ __('dashboard.status_running') }}"},
  {title:"{{ __('dashboard.title_leadership') }}", category:"{{ __('dashboard.cat_soft_skill') }}", organizer:"{{ __('dashboard.org_internal') }}", start:"2026-02-14", end:"2026-02-14", participants:8, quota:20, status:"{{ __('dashboard.status_scheduled') }}"},
  {title:"{{ __('dashboard.title_iso') }}", category:"{{ __('dashboard.cat_cert_prof') }}", organizer:"Vendor Qualita", start:"2026-01-20", end:"2026-01-21", participants:14, quota:14, status:"{{ __('dashboard.status_finished') }}"},
];

let certs = [
  {employee:"Rina Amelia", training:"{{ __('dashboard.title_iso') }}", issued:"2026-01-22", expiry:"2026-04-22"},
  {employee:"Dimas Prasetyo", training:"{{ __('dashboard.title_k3') }}", issued:"2025-09-10", expiry:"2026-03-10"},
  {employee:"Siti Nurjanah", training:"{{ __('dashboard.title_leadership') }}", issued:"2025-11-01", expiry:"2027-11-01"},
];

function daysUntil(dateStr){
  const diff = new Date(dateStr) - new Date("2026-02-05");
  return Math.ceil(diff / (1000*60*60*24));
}

function statusBadge(status){
  const map = {"{{ __('dashboard.status_running') }}":"green","{{ __('dashboard.status_scheduled') }}":"gray","{{ __('dashboard.status_finished') }}":"gray"};
  return `<span class="badge ${map[status]||'gray'}">${status}</span>`;
}

function certBadge(expiry){
  const d = daysUntil(expiry);
  if(d < 0) return '<span class="badge red">{{ __("dashboard.expired") }}</span>';
  if(d <= 30) return `<span class="badge amber">{{ __("dashboard.cert_expiring") }} · ${d}h</span>`;
  return '<span class="badge green">{{ __("dashboard.active") }}</span>';
}

function renderTrainings(){
  const body = document.getElementById('trainingBody');
  if(trainings.length === 0){
    body.innerHTML = `<tr class="empty-row"><td colspan="7">{{ __('dashboard.empty_training') }}</td></tr>`;
    return;
  }
  body.innerHTML = trainings.map((t,i)=>`
    <tr>
      <td class="name-cell"><strong>${t.title}</strong><span>${t.organizer}</span></td>
      <td>${t.category}</td>
      <td>${t.organizer}</td>
      <td>${formatDate(t.start)} – ${formatDate(t.end)}</td>
      <td>${t.participants}/${t.quota}</td>
      <td>${statusBadge(t.status)}</td>
      <td>
        <div class="row-actions" style="justify-content:flex-end;">
          <button class="icon-btn" title="{{ __('dashboard.tooltip_edit') }}" onclick="editTraining(${i})"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg></button>
          <button class="icon-btn danger" title="{{ __('dashboard.tooltip_delete') }}" onclick="deleteTraining(${i})"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg></button>
        </div>
      </td>
    </tr>
  `).join('');
}

function renderCerts(){
  const body = document.getElementById('certBody');
  if(certs.length === 0){
    body.innerHTML = `<tr class="empty-row"><td colspan="6">{{ __('dashboard.empty_cert') }}</td></tr>`;
    return;
  }
  body.innerHTML = certs.map((c,i)=>`
    <tr>
      <td class="name-cell"><strong>${c.employee}</strong></td>
      <td>${c.training}</td>
      <td>${formatDate(c.issued)}</td>
      <td>${formatDate(c.expiry)}</td>
      <td>${certBadge(c.expiry)}</td>
      <td>
        <div class="row-actions" style="justify-content:flex-end;">
          <button class="icon-btn" title="{{ __('dashboard.tooltip_view_file') }}"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5Z"/><path d="M14 2v6h6"/></svg></button>
          <button class="icon-btn" title="{{ __('dashboard.tooltip_edit') }}" onclick="editCert(${i})"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg></button>
          <button class="icon-btn danger" title="{{ __('dashboard.tooltip_delete') }}" onclick="deleteCert(${i})"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg></button>
        </div>
      </td>
    </tr>
  `).join('');
}

function formatDate(iso){
  const d = new Date(iso);
  return d.toLocaleDateString('id-ID',{day:'2-digit',month:'short',year:'numeric'});
}

function updateStats(){
  document.getElementById('statTraining').textContent = trainings.filter(t=>t.status==='Berjalan').length + trainings.filter(t=>t.status==='Terjadwal').length;
  document.getElementById('statPeserta').textContent = trainings.reduce((a,t)=>a+t.participants,0);
  document.getElementById('statCertActive').textContent = certs.filter(c=>daysUntil(c.expiry)>30).length;
  document.getElementById('statCertExpiring').textContent = certs.filter(c=>daysUntil(c.expiry)<=30 && daysUntil(c.expiry)>=0).length;
}

// ---------- Tabs ----------
function switchTab(tab){
  document.querySelectorAll('.tab-btn').forEach(b=>b.classList.toggle('active', b.dataset.tab===tab));
  document.getElementById('panel-training').style.display = tab==='training' ? 'block' : 'none';
  document.getElementById('panel-certs').style.display = tab==='certs' ? 'block' : 'none';
}

// ---------- Modal: Training ----------
let editingIndex = null;
function openTrainingModal(){
  editingIndex = null;
  document.getElementById('trainingModalTitle').textContent = '{{ __('dashboard.modal_add_training') }}';
  ['f_title','f_organizer','f_location','f_quota'].forEach(id=>document.getElementById(id).value='');
  document.getElementById('f_start').value='';
  document.getElementById('f_end').value='';
  document.getElementById('trainingModalOverlay').classList.add('show');
}
function editTraining(i){
  editingIndex = i;
  const t = trainings[i];
  document.getElementById('trainingModalTitle').textContent = '{{ __('dashboard.modal_edit_training') }}';
  document.getElementById('f_title').value = t.title;
  document.getElementById('f_category').value = t.category;
  document.getElementById('f_organizer').value = t.organizer;
  document.getElementById('f_start').value = t.start;
  document.getElementById('f_end').value = t.end;
  document.getElementById('f_quota').value = t.quota;
  document.getElementById('trainingModalOverlay').classList.add('show');
}
function saveTraining(){
  const title = document.getElementById('f_title').value.trim();
  if(!title){ alert('{{ __('dashboard.alert_training_name') }}'); return; }
  const data = {
    title,
    category: document.getElementById('f_category').value,
    organizer: document.getElementById('f_organizer').value || '-',
    start: document.getElementById('f_start').value,
    end: document.getElementById('f_end').value,
    quota: Number(document.getElementById('f_quota').value) || 0,
    participants: editingIndex!==null ? trainings[editingIndex].participants : 0,
    status: 'Terjadwal'
  };
  if(editingIndex!==null){
    trainings[editingIndex] = {...trainings[editingIndex], ...data};
  } else {
    trainings.push(data);
  }
  renderTrainings(); updateStats();
  closeModal('trainingModalOverlay');
}
let deleteType = null;
let deleteIndex = null;
function deleteTraining(i){
  deleteType = 'training';
  deleteIndex = i;
  document.getElementById('deleteModalBody').textContent = '{{ __('dashboard.confirm_delete_training') }}';
  document.getElementById('deleteModalOverlay').classList.add('show');
}

// ---------- Modal: Certificate ----------
let editingCertIndex = null;
function openCertModal(){
  editingCertIndex = null;
  document.getElementById('certModalTitle').textContent = '{{ __('dashboard.modal_upload_cert') }}';
  document.getElementById('c_employee').value = document.getElementById('c_employee').options[0].value;
  document.getElementById('c_training').value = document.getElementById('c_training').options[0].value;
  document.getElementById('c_issued').value = '';
  document.getElementById('c_expiry').value = '';
  document.getElementById('certModalOverlay').classList.add('show');
}
function editCert(i){
  editingCertIndex = i;
  const c = certs[i];
  document.getElementById('certModalTitle').textContent = '{{ __('dashboard.modal_edit_cert') }}';
  
  const empSelect = document.getElementById('c_employee');
  for (let opt of empSelect.options) {
      if (opt.text.includes(c.employee)) {
          empSelect.value = opt.value;
          break;
      }
  }

  const trnSelect = document.getElementById('c_training');
  for (let opt of trnSelect.options) {
      if (opt.text.includes(c.training)) {
          trnSelect.value = opt.value;
          break;
      }
  }
  
  document.getElementById('c_issued').value = c.issued;
  document.getElementById('c_expiry').value = c.expiry;
  document.getElementById('certModalOverlay').classList.add('show');
}
function saveCert(){
  const employee = document.getElementById('c_employee').value.split(' — ')[0].split(' — ')[0]; // safely split depending on lang
  const training = document.getElementById('c_training').value;
  const issued = document.getElementById('c_issued').value || '2026-02-05';
  const expiry = document.getElementById('c_expiry').value || '2026-12-31';
  
  if (editingCertIndex !== null) {
      certs[editingCertIndex] = {employee, training, issued, expiry};
  } else {
      certs.push({employee, training, issued, expiry});
  }
  renderCerts(); updateStats();
  closeModal('certModalOverlay');
}
function deleteCert(i){
  deleteType = 'cert';
  deleteIndex = i;
  document.getElementById('deleteModalBody').textContent = '{{ __('dashboard.confirm_delete_cert') }}';
  document.getElementById('deleteModalOverlay').classList.add('show');
}
function executeDelete() {
  if (deleteType === 'training') {
    trainings.splice(deleteIndex, 1);
    renderTrainings(); updateStats();
  } else if (deleteType === 'cert') {
    certs.splice(deleteIndex, 1);
    renderCerts(); updateStats();
  }
  closeModal('deleteModalOverlay');
}

function closeModal(id){
  document.getElementById(id).classList.remove('show');
}
document.querySelectorAll('.modal-overlay').forEach(ov=>{
  ov.addEventListener('click', e=>{ if(e.target===ov) ov.classList.remove('show'); });
});

// ---------- Filter ----------
function filterTable(tableId, query){
  const rows = document.querySelectorAll(`#${tableId} tbody tr`);
  query = query.toLowerCase();
  rows.forEach(r=>{
    r.style.display = r.textContent.toLowerCase().includes(query) ? '' : 'none';
  });
}

// ---------- Init ----------
renderTrainings();
renderCerts();
updateStats();
</script>
</body>
</html>
