<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Firefish Dashboard</title>
  <link rel="icon" href="logo-bitcoin.png" type="image/png">
</head>
<body style="margin:0">
    <div id="ffd-root">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap');
    /* ═══════════════════════════════════════════════════════════
       FULL ISOLATION — overrides every WP theme reset/global CSS
       All rules use #ffd-root prefix +
    ═══════════════════════════════════════════════════════════ */
    #ffd-root { all: initial; display: block; }
    #ffd-root *, #ffd-root *::before, #ffd-root *::after {
      box-sizing: border-box;
      font-family: 'Montserrat', -apple-system, BlinkMacSystemFont, sans-serif;
      -webkit-font-smoothing: antialiased;
    }

    /* ── Design tokens (light) ── */
    #ffd-root {
      --bg: #ffffff; --bg2: #f9fafb; --bg3: #f3f4f6;
      --border: #e5e7eb; --border2: #d1d5db;
      --text: #111827; --text2: #374151; --text3: #6b7280; --text4: #9ca3af;
      --accent: #F97316; --accent-bg: #fff7ed;
      --ok: #16a34a; --ok-bg: #f0fdf4; --ok-border: #bbf7d0;
      --warn: #d97706; --warn-bg: #fffbeb; --warn-border: #fde68a;
      --err: #dc2626; --err-bg: #fef2f2; --err-border: #fecaca;
      --card-bg: #ffffff; --card-shadow: 0 1px 3px rgba(0,0,0,.07);
    }
    #ffd-root.dark {
      --bg: #0f172a; --bg2: #1e293b; --bg3: #334155;
      --border: #334155; --border2: #475569;
      --text: #f1f5f9; --text2: #cbd5e1; --text3: #94a3b8; --text4: #64748b;
      --accent: #fb923c; --accent-bg: #431407;
      --ok: #4ade80; --ok-bg: #052e16; --ok-border: #166534;
      --warn: #fbbf24; --warn-bg: #451a03; --warn-border: #92400e;
      --err: #f87171; --err-bg: #450a0a; --err-border: #991b1b;
      --card-bg: #1e293b; --card-shadow: 0 1px 3px rgba(0,0,0,.3);
    }
    #ffd-root { background: var(--bg); color: var(--text); border-radius: 0px; overflow: hidden; font-size: 14px; line-height: 1.5; }

    /* ── Wrapper ── */
    #ffd-root .w { padding: 1.25rem 1rem 2rem; }

    /* ── Header ── */
    #ffd-root .hdr { display: flex; align-items: center; justify-content: space-between; margin: 0 0 1.25rem; flex-wrap: wrap; gap: 8px; }
    #ffd-root .logo { display: flex; align-items: center; gap: 8px; }
    #ffd-root .logo-icon { width: 26px; height: 26px; min-width: 26px; background: #F97316; border-radius: 6px; display: flex; align-items: center; justify-content: center; }
    #ffd-root .logo-icon svg { width: 14px; height: 14px; fill: white; display: block; }
    #ffd-root .logo-text { font-size: 16px; font-weight: 600; color: var(--text); }
    #ffd-root .pills { display: flex; gap: 6px; flex-wrap: wrap; align-items: center; }
    #ffd-root #pills-btc-fiats { display: flex; gap: 6px; flex-wrap: wrap; align-items: center; }
    #ffd-root .pill {
      font-size: 11px; padding: 3px 10px; border-radius: 10px;
      border: 1px solid var(--border); color: var(--text3); background: var(--bg2);
      display: inline-flex; align-items: center; gap: 3px; margin: 0;
    }
    #ffd-root .pill b { color: var(--text); font-weight: 600; }

    /* ── Rate bar ── */
    #ffd-root .pill input {
      background: transparent; border: none; outline: none; font-weight: 600;
      color: var(--text); font-size: 11px; width: 70px; padding: 0;
      font-family: inherit; text-align: right;
    }
    /* ── Hide amounts ── */
    #ffd-root.hide-amounts .mc-val,
    #ffd-root.hide-amounts .mc-sub,
    #ffd-root.hide-amounts .lv,
    #ffd-root.hide-amounts .rv,
    #ffd-root.hide-amounts .ccy-val,
    #ffd-root.hide-amounts .pill input,
    #ffd-root.hide-amounts #p-btc,
    #ffd-root.hide-amounts .note,
    #ffd-root.hide-amounts #st-btc,
    #ffd-root.hide-amounts #st-r,
    #ffd-root.hide-amounts .amt,
    #ffd-root.hide-amounts .cd-days,
    #ffd-root.hide-amounts .cd-meta,
    #ffd-root.hide-amounts #del-modal-name,
    #ffd-root.hide-amounts #wc-pct,
    #ffd-root.hide-amounts #wc-r,
    #ffd-root.hide-amounts .stat-val,
    #ffd-root.hide-amounts #ov-ltv,
    #ffd-root.hide-amounts #cv-grid,
    #ffd-root.hide-amounts #debt-stats,
    #ffd-root.hide-amounts .hdr-stat-val,
    #ffd-root.hide-amounts .hdr-stat-tooltip,
    #ffd-root.hide-amounts #ov-multi,
    #ffd-root.hide-amounts #sx-content,
    #ffd-root.hide-amounts #ro-content,
    #ffd-root.hide-amounts #ch-gantt,
    #ffd-root.hide-amounts .lid,
    #ffd-root.hide-amounts .lid-sub,
    #ffd-root.hide-amounts .tlabel,
    #ffd-root.hide-amounts .fxsb,
    #ffd-root.hide-amounts #s-ch.on { filter: blur(6px); user-select: none; pointer-events: none; }
    #ffd-root.hide-amounts #hide-btn { color: var(--accent); }

    /* ── Inputs / Selects — fight every theme ── */
    #ffd-root input,
    #ffd-root select,
    #ffd-root textarea {
      font-size: 13px; padding: 6px 10px; border-radius: 8px;
      border: 1px solid var(--border2); background: var(--card-bg); color: var(--text);
      box-shadow: none; outline: none;
      -webkit-appearance: auto; appearance: auto;
      width: auto; height: auto; margin: 0;
      line-height: 1.4; vertical-align: middle;
      display: inline-block;
    }
    #ffd-root input:focus, #ffd-root select:focus { border-color: #F97316; box-shadow: 0 0 0 2px rgba(249,115,22,.15); }
    #ffd-root input.sm { width: 110px; }
    #ffd-root select { cursor: pointer; }
    /* ── Vor-Kredit Tool Fields ── */
    #ffd-root .vor-field { display:flex; flex-direction:column; gap:.3rem; }
    #ffd-root .vor-field > label { font-size:12px; font-weight:600; color:var(--text2); margin:0; }
    #ffd-root .vor-field input, #ffd-root .vor-field select { width:100%; }
    #ffd-root .vor-field label label, #ffd-root .vor-field div label { font-size:13px; font-weight:400; color:var(--text); display:inline-flex; align-items:center; gap:.3rem; white-space:nowrap; }
    #ffd-root label:has(input[type="radio"]) { display:inline-flex; align-items:center; gap:.3rem; white-space:nowrap; font-weight:400 !important; }
    /* ── Range slider ── */
    #ffd-root input[type=range] { -webkit-appearance:none; appearance:none; width:100%; height:4px; border-radius:2px; background:var(--border2); outline:none; border:none; box-shadow:none; padding:0; cursor:pointer; }
    #ffd-root input[type=range]::-webkit-slider-thumb { -webkit-appearance:none; appearance:none; width:18px; height:18px; border-radius:50%; background:var(--accent); border:2px solid #fff; box-shadow:0 1px 4px rgba(0,0,0,.2); cursor:pointer; transition:transform .1s; }
    #ffd-root input[type=range]::-webkit-slider-thumb:hover { transform:scale(1.2); }
    #ffd-root input[type=range]::-moz-range-thumb { width:18px; height:18px; border-radius:50%; background:var(--accent); border:2px solid #fff; box-shadow:0 1px 4px rgba(0,0,0,.2); cursor:pointer; }
    #ffd-root input[type=range]:focus { box-shadow:none; border:none; }

    /* ── Buttons — fight every theme ── */
    #ffd-root button {
      display: inline-flex; align-items: center; justify-content: center;
      gap: 4px; padding: 6px 14px; font-size: 13px; font-weight: 400;
      color: var(--text2); background: var(--card-bg); border: 1px solid var(--border2);
      border-radius: 8px; cursor: pointer; line-height: 1.4;
      margin: 0; text-decoration: none; box-shadow: none;
      transition: background .12s; white-space: nowrap;
      -webkit-appearance: none; appearance: none;
    }
    #ffd-root button:hover { background: var(--bg3); }
    #ffd-root button:focus { outline: none; box-shadow: 0 0 0 2px rgba(249,115,22,.2); }
    #ffd-root button.sm { padding: 4px 10px; font-size: 12px; }
    #ffd-root button.primary { background: #F97316; color: #fff; border-color: #F97316; font-weight: 500; }
    #ffd-root button.primary:hover { background: #ea6c0b; }
    #ffd-root button.del { color: #dc2626; background: transparent; border-color: transparent; padding: 2px 7px; }
    #ffd-root button.del:hover { background: var(--err-bg); }

    /* ── Tabs ── */
    #ffd-root .tabs { display: flex; gap: 0; margin: 0 0 1.25rem; border-bottom: 1px solid var(--border); overflow-x: auto; }
    #ffd-root .tab {
      padding: 8px 13px; font-size: 13px; color: var(--text3);
      background: transparent; border: none; border-bottom: 2px solid transparent;
      margin: 0 0 -1px; cursor: pointer; flex-shrink: 0; font-weight: 400;
      transition: color .15s; white-space: nowrap;
    }
    #ffd-root .tab:hover { color: var(--text); background: transparent; }
    #ffd-root .tab.on { color: #F97316; border-bottom: 2px solid #F97316; font-weight: 600; }

    /* ── Sections ── */
    #ffd-root .sec { display: none; }
    #ffd-root .sec.on { display: grid; }

    /* ── Metric grid ── */
    #ffd-root .mg { display: grid; grid-template-columns: repeat(auto-fit,minmax(250px,1fr)); gap: 10px; margin: 0 0 1.25rem; }
    #ffd-root .mc { background: var(--bg2); border-radius: 8px; padding: .85rem 1rem; }
    #ffd-root #s-sx .mc { border: 1px solid var(--border); border-radius: 12px; }
    #ffd-root .mc-lbl { font-size: 12px; color: var(--text3); margin: 0 0 4px; display: block; }
    #ffd-root .mc-val { font-size: 18px; font-weight: 700; color: var(--text); display: block; }
    #ffd-root .mc-sub { font-size: 11px; color: var(--text4); margin: 2px 0 0; display: block; }

    /* ── Section heading ── */
    #ffd-root .sh { font-size: 12px; font-weight: 700; color: var(--text3); letter-spacing: .07em; text-transform: uppercase; margin: 0 0 .7rem; display: block; }
    #ffd-root .mt { margin-top: 1rem; }
    #ffd-root .mb { margin-bottom: .75rem; }

    /* ── Card ── */
    #ffd-root .card {
      background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px;
      padding: 1rem 1.1rem;
      transition: border-color .15s;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
    }
    #ffd-root .card:hover { border-color: var(--border2); }
    #ffd-root .card-title { font-size: 14px; font-weight: 600; color: var(--text); margin: 0 0 .75rem; display: block; }

    /* ── Loan card internals ── */
    #ffd-root .lh { display: flex; justify-content: space-between; align-items: flex-start; margin: 0 0 .7rem;flex-wrap: wrap;gap: 6px; }
    #ffd-root .lid { font-size: 14px; font-weight: 600; color: var(--text); display: flex;
    justify-content: space-between;
    align-items: center;flex-wrap: wrap;width: 100%;}
    #ffd-root .lid-sub { color: var(--text4); font-weight: 400; font-size: 11px; }
    #ffd-root .lmeta { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 8px; margin: 0 0 .7rem; }
    #ffd-root .ll { font-size: 11px; color: var(--text4); margin: 0 0 2px; display: block; }
    #ffd-root .lv { font-size: 13px; font-weight: 500; color: var(--text); display: block; }

    /* ── Badge ── */
    #ffd-root .badge { font-size: 11px; padding: 2px 9px; border-radius: 20px; display: inline-block; font-weight: 500;width: max-content; }
    #ffd-root .ba { background: var(--ok-bg); color: var(--ok); border: 1px solid var(--ok-border); }
    #ffd-root .bc { background: var(--bg2); color: var(--text3); border: 1px solid var(--border); }

    /* ── LTV bar ── */
    #ffd-root .ltv-bg { height: 6px; background: var(--bg3); border-radius: 3px; margin: .4rem 0 0; overflow: hidden; }
    #ffd-root .ltv-fill { height: 6px; border-radius: 3px; transition: width .4s; display: block; }
    #ffd-root .ltv-row { display: flex; justify-content: space-between; font-size: 11px; color: var(--text4); margin: 0 0 2px; }

    /* ── Progress ── */
    #ffd-root .prog-row { display: flex; justify-content: space-between; font-size: 11px; color: var(--text3); margin: 0 0 3px; }
    #ffd-root .prog-bg { height: 4px; background: var(--bg3); border-radius: 2px; overflow: hidden; margin: 0 0 .35rem; }
    #ffd-root .prog-fill { height: 4px; background: #F97316; border-radius: 2px; display: block; }

    /* ── Currency grid ── */
    #ffd-root .ccyg { display: grid; grid-template-columns: repeat(auto-fit,minmax(0,1fr)); gap: 6px; margin: .5rem 0 0; }
    #ffd-root .ccyc { background: var(--bg2); border-radius: 8px; padding: .5rem .75rem; }
    #ffd-root .ccy-lbl { font-size: 10px; color: var(--text4); margin: 0 0 2px; display: block; }
    #ffd-root .ccy-val { font-size: 13px; font-weight: 600; color: var(--text); display: block; }

    /* ── Tool row ── */
    #ffd-root .tr { display: flex; align-items: center; gap: 10px; margin: 0 0 8px; flex-wrap: wrap; }
    #ffd-root .tr label { font-size: 13px; color: var(--text3); min-width: 150px; margin: 0; }
    #ffd-root .tr input { width: 130px; }

    /* ── Result box ── */
    #ffd-root .rb { background: var(--bg2); border-radius: 8px; padding: .75rem 1rem; margin: .5rem 0 0; }
    #ffd-root .rr { display: flex; justify-content: space-between; font-size: 13px; padding: 5px 0; border-bottom: 1px solid var(--border); }
    #ffd-root .rr:last-child { border-bottom: none; }
    #ffd-root .rl { color: var(--text3); }
    #ffd-root .rv { font-weight: 600; color: var(--text); }

    /* ── Status colors ── */
    #ffd-root .ok  { color: var(--ok); }
    #ffd-root .wrn { color: var(--warn); }
    #ffd-root .err { color: var(--err); }

    /* ── Add form ── */
    #ffd-root .add-panel { background: var(--bg2); border-radius: 12px; padding: 1rem; margin: 0 0 1.25rem; border: 1px solid var(--border); }
    #ffd-root .add-title { font-size: 13px; font-weight: 600; color: var(--text); margin: 0 0 .75rem; display: block; }
    #ffd-root .fg { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin: 0 0 10px; }
    #ffd-root .ff { display: flex; flex-direction: column; gap: 4px; }
    #ffd-root .ff label { font-size: 12px; color: var(--text3); }
    #ffd-root .ff input, #ffd-root .ff select { width: 100%; }
    #ffd-root .fa { display: flex; gap: 8px; justify-content: flex-end; margin: 8px 0 0; }

    /* ── Stress table ── */
    #ffd-root table { width: 100%; border-collapse: collapse; }
    #ffd-root th { font-size: 11px; color: var(--text3); font-weight: 600; padding: 6px 8px; text-align: left; border-bottom: 1px solid var(--border); background: transparent; }
    #ffd-root td { padding: 7px 8px; border-bottom: 1px solid var(--bg2); color: var(--text); background: transparent; }
    #ffd-root tr:last-child td { border-bottom: none; }
    #ffd-root .chip { display: inline-block; padding: 2px 7px; border-radius: 10px; font-size: 11px; font-weight: 600; }
    #ffd-root #st-r table { width: max-content; min-width: 100%; }
    #ffd-root #st-r .ovx { overflow-x: auto; -webkit-overflow-scrolling: touch; min-width: 0; }
    #ffd-root #s-st .card { overflow: hidden; min-width: 0; }
    #ffd-root #st-r th:first-child,
    #ffd-root #st-r td:first-child {
      position: sticky; left: 0; z-index: 2;
      background: var(--card-bg);
      box-shadow: 2px 0 4px rgba(0,0,0,.06);
    }
    #ffd-root #st-r tr:hover td:first-child { background: var(--bg2); }

    /* ── Calendar ── */
    #ffd-root .cg { display: grid; grid-template-columns: repeat(7,1fr); gap: 3px; margin: .5rem 0 0; }
    #ffd-root .ch { font-size: 11px; color: var(--text4); text-align: center; padding: 4px 0; }
    #ffd-root .cd { min-height: 38px; border-radius: 6px; padding: 3px 5px; background: transparent; border: 1px solid transparent; }
    #ffd-root .cd.today { border-color: #F97316; }
    #ffd-root .cdn { font-size: 11px; color: var(--text3); }
    #ffd-root .ce { font-size: 10px; background: #F97316; color: #fff; border-radius: 3px; padding: 1px 3px; margin: 1px 0 0; display: block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    #ffd-root .ce.due { background: #dc2626; }
    #ffd-root .cal-nav { display: flex; align-items: center; justify-content: space-between; margin: 0 0 .5rem; }
    #ffd-root .cal-title { font-size: 14px; font-weight: 600; color: var(--text); }


    /* ── Timeline ── */
    #ffd-root #upcoming { display: flex; flex-direction: column; gap: 0.5rem; }
    #ffd-root .tl { padding: 0 0 0 1rem; }
    #ffd-root .ti { position: relative; padding: 0 0 1.2rem 1.2rem; border-left: 1px solid var(--border); }
    #ffd-root .ti:last-child { border-left: 1px solid transparent; }
    #ffd-root .dot { position: absolute; left: -5px; top: 4px; width: 9px; height: 9px; border-radius: 50%; background: #F97316; border: 2px solid var(--card-bg); }
    #ffd-root .dot.done { background: var(--border2); }
    #ffd-root .dot.soon { background: #dc2626; }
    #ffd-root .tdate { font-size: 11px; color: var(--text4); margin: 0 0 2px; display: block; }
    #ffd-root .tlabel { font-size: 13px; font-weight: 600; color: var(--text); }
    #ffd-root .tsub { font-size: 12px; color: var(--text3); margin: 0 0 2px; display: block; }

    /* ── CCY switcher ── */
    #ffd-root .csw { display: flex; gap: 4px; flex-wrap: wrap; margin: 0 0 .75rem; }
    #ffd-root .cb { padding: 4px 12px; font-size: 12px; border: 1px solid var(--border); border-radius: 20px; background: transparent; color: var(--text3); cursor: pointer; font-weight: 400; }
    #ffd-root .cb:hover { background: var(--bg2); }
    #ffd-root .cb.on { background: var(--text); color: var(--bg); border-color: var(--text); font-weight: 600; }

    /* ── Chart wrapper ── */
    #ffd-root .ch-wrap { position: relative; width: 100%; height: 240px; }


    /* ── Stats ── */
    #ffd-root .stats { display: flex; gap: 8px; margin: .75rem 0 0; flex-wrap: wrap; }
    #ffd-root .stat { flex: 1; min-width: 80px; background: var(--bg2); border-radius: 8px; padding: .6rem .75rem; }
    #ffd-root .stat-lbl { font-size: 11px; color: var(--text4); margin: 0 0 2px; display: block; }
    #ffd-root .stat-val { font-size: 13px; font-weight: 600; color: var(--text); display: block; }

    /* ── Flex helpers ── */
    #ffd-root .fx { display: flex; align-items: center; gap: 6px; }
    #ffd-root .fxsb { display: flex; justify-content: space-between; align-items: center; }
    #ffd-root .empty { text-align: center; padding: 2rem; color: var(--text4); font-size: 14px; }
    #ffd-root .note { font-size: 11px; color: var(--text4); }
    #ffd-root .note2 { font-size: 12px; color: var(--text3); white-space: break-spaces;}
    #ffd-root .ovx { overflow-x: auto; }
    #ffd-root p, #ffd-root ul, #ffd-root ol, #ffd-root li { margin: 0; padding: 0; list-style: none; }

    /* ── Loans grid ── */
    #ffd-root #loans-list { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1rem; }
    #ffd-root #loans-list .empty { grid-column: 1 / -1; }

    /* ── Sort buttons ── */
    /* ── View toggle ── */
    #ffd-root .view-toggle { display: flex; gap: 3px; }
    #ffd-root .view-btn { padding: 4px 8px; font-size: 13px; border: 1px solid var(--border); border-radius: 6px; background: transparent; color: var(--text4); cursor: pointer; line-height: 1; }
    #ffd-root .view-btn:hover { background: var(--bg3); color: var(--text2); }
    #ffd-root .view-btn.on { background: var(--text); color: var(--bg); border-color: var(--text); }

    /* ── Table view ── */
    #ffd-root .ovx { overflow-x: auto; }
    #ffd-root .loans-table { width: 100%; border-collapse: collapse; font-size: 13px; }
    #ffd-root .loans-table th { text-align: left; font-size: 11px; font-weight: 600; color: var(--text4); padding: 6px 10px; border-bottom: 1px solid var(--border); white-space: nowrap; cursor: pointer; user-select: none; }
    #ffd-root .loans-table th:hover { color: var(--text2); }
    #ffd-root .loans-table td { padding: 8px 10px; border-bottom: 1px solid var(--bg3); vertical-align: middle; }
    #ffd-root .loans-table tr:last-child td { border-bottom: none; }
    #ffd-root .loans-table tr:hover td { background: var(--bg2); }
    #ffd-root .loans-table .tbl-name { font-weight: 600; color: var(--text); }
    #ffd-root .loans-table .tbl-id { font-size: 11px; color: var(--text4); }
    #ffd-root .loans-table .tbl-ltv-bar { height: 4px; border-radius: 2px; background: var(--bg3); margin-top: 3px; width: 80px; }
    #ffd-root .loans-table .tbl-ltv-fill { height: 4px; border-radius: 2px; }
    #ffd-root .loans-table .tbl-actions { display: flex; gap: 4px; }

    #ffd-root .filter-tabs { display: flex; gap: 4px; margin: 0; border-bottom: 1px solid var(--border); }
    #ffd-root .filter-tab { padding: 6px 16px; font-size: 13px; font-weight: 500; color: var(--text3); background: transparent; border: none; border-bottom: 2px solid transparent; cursor: pointer; margin-bottom: -1px; }
    #ffd-root .filter-tab:hover { color: var(--text); }
    #ffd-root .filter-tab.on { color: #F97316; border-bottom-color: #F97316; font-weight: 600; }

    #ffd-root .sort-btn {
      padding: 3px 10px; font-size: 12px; border: 1px solid var(--border);
      border-radius: 20px; background: transparent; color: var(--text3);
      cursor: pointer; white-space: nowrap;
    }
    #ffd-root .sort-btn:hover { background: var(--bg3); color: var(--text); }
    #ffd-root .sort-btn.on { background: var(--text); color: var(--bg); border-color: var(--text); font-weight: 600; }

    /* ── Edit modal ── */
    #ffd-root .modal-bg {
      position: fixed; inset: 0; background: rgba(0,0,0,.45);
      z-index: 99999; display: none; align-items: center; justify-content: center;
      padding: 1rem;
    }
    #ffd-root .modal-bg.open { display: flex; }
    #ffd-root .modal {
      background: var(--card-bg); border-radius: 14px; padding: 1.5rem;
      width: 100%; max-width: 520px; box-shadow: 0 20px 60px rgba(0,0,0,.25);
      max-height: 90vh; overflow-y: auto;
    }
    #ffd-root .modal-title {
      font-size: 16px; font-weight: 700; color: var(--text);
      margin: 0 0 1.1rem; display: flex; justify-content: space-between; align-items: center;
    }
    #ffd-root .modal-close {
      background: transparent; border: none; font-size: 18px;
      color: var(--text4); cursor: pointer; padding: 0 4px; line-height: 1;
    }
    #ffd-root .modal-close:hover { color: var(--text); }
    #ffd-root .modal-actions { display: flex; gap: 8px; justify-content: flex-end; margin: 1rem 0 0; }
    #ffd-root .import-strat-btn { display: flex; align-items: center; gap: 12px; padding: .65rem .9rem; border: 2px solid var(--border); border-radius: 10px; background: var(--card-bg); color: var(--text2); cursor: pointer; text-align: left; width: 100%; transition: border-color .15s, background .15s; font-size: 13px; }
    #ffd-root .import-strat-btn > div { min-width: 0; flex: 1; }
    #ffd-root .import-strat-btn:hover { border-color: var(--accent); background: var(--accent-bg); }
    #ffd-root .import-strat-btn.on { border-color: var(--accent); background: var(--accent-bg); color: var(--accent); }
    #ffd-root .import-confirm-label { padding: 6px 14px; font-size: 13px; border-radius: 8px; cursor: pointer; display: inline-flex; align-items: center; border: 1px solid var(--border); background: var(--bg3); color: var(--text4); pointer-events: none; transition: background .15s, color .15s, border-color .15s; }
    #ffd-root .import-confirm-label.active { background: var(--text); color: var(--bg); border-color: var(--text); pointer-events: auto; }
    #ffd-root.dark .import-confirm-label.active { background: var(--accent); border-color: var(--accent); color: #fff; }

    /* ── Sidebar layout ── */
    #ffd-root .layout { display: flex; align-items: flex-start; }
    #ffd-root .sidebar {
      width: 200px; min-width: 200px; flex-shrink: 0;
      background: var(--bg2); border-right: 1px solid var(--border);
      padding: 20px; display: flex; flex-direction: column;
      gap: 2px;
      position: fixed; top: 0; left: 0; height: 100vh; overflow-y: auto; z-index: 100;
    }
    #ffd-root .main { margin-left: 200px; }
    #ffd-root .sidebar-logo {
      display: flex; align-items: center; gap: 8px;
      padding: 0 1rem 1rem; margin-bottom: .25rem;
      border-bottom: 1px solid var(--border);
    }
    #ffd-root .sidebar-logo-icon { width: 28px; height: 28px; min-width: 28px; border-radius: 7px; display: flex; align-items: center; justify-content: center; }
    #ffd-root .logo-img { filter: none; }
    #ffd-root.dark .logo-img { filter: invert(1) sepia(1) saturate(3) hue-rotate(340deg) brightness(1.1); }
    #ffd-root .sidebar-logo-icon svg { width: 18px; height: 18px; fill: white; display: block; }
    #ffd-root .sidebar-logo-text { font-size: 14px; font-weight: 700; color: var(--text); }
    #ffd-root .nav-section { font-size: 10px; font-weight: 700; color: var(--text4); letter-spacing: .08em; text-transform: uppercase; padding: .75rem 1rem .35rem; display: block; }
    #ffd-root .nav-item {
      display: flex; align-items: center; gap: 9px;
      padding: 8px 1rem; font-size: 13px; font-weight: 400;
      color: var(--text2); cursor: pointer; background: transparent;
      border: none; width: 100%; text-align: left;
      border-radius: 0; transition: background .12s, color .12s;
      white-space: nowrap; margin: 0;
      justify-content: flex-start;
    }
    #ffd-root .nav-item:hover { background: var(--bg3); color: var(--text); }
    #ffd-root .nav-item.on {
      background: var(--accent-bg); color: var(--accent); font-weight: 600;
      border-right: 2px solid #F97316;
    }
    #ffd-root .nav-item .nav-icon { width: 16px; height: 16px; flex-shrink: 0; opacity: .6; }
    #ffd-root .nav-item.on .nav-icon { opacity: 1; }
    #ffd-root .sidebar-footer { margin-top: auto; padding: 1rem 1rem 0; border-top: 1px solid var(--border); text-align: center; }
    /* Collapsed sidebar */
    #ffd-root .sidebar.collapsed { width: 52px; min-width: 52px; padding: 16px 0; }
    #ffd-root .main.sidebar-collapsed { margin-left: 52px; }
    #ffd-root .sidebar.collapsed .nav-item { justify-content: center; padding: 10px 0; gap: 0; }
    #ffd-root .sidebar.collapsed .nav-item span:not(.nav-icon) { display: none; }
    #ffd-root .sidebar.collapsed .nav-section { display: none; }
    #ffd-root .sidebar.collapsed .sidebar-logo-text { display: none; }
    #ffd-root .sidebar.collapsed .sidebar-logo-icon { display: none; }
    #ffd-root .sidebar.collapsed .sidebar-logo { padding: 0 0 .75rem; justify-content: center; }
    #ffd-root .sidebar.collapsed .sidebar-footer { padding: .5rem 0 0; text-align: center; }
    #ffd-root .sidebar.collapsed .sidebar-footer-note { display: none; }
    #ffd-root .sidebar.collapsed .nav-item .nav-icon { opacity: .7; }
    #ffd-root .sidebar.collapsed .nav-item.on .nav-icon { opacity: 1; }
    #ffd-root .sidebar-toggle { background: none; border: none; cursor: pointer; color: var(--text3); padding: 2px 4px; border-radius: 4px; font-size: 14px; line-height: 1; }
    #ffd-root .sidebar-toggle:hover { color: var(--text); background: var(--bg3); }
    #ffd-root .sidebar.collapsed .sidebar-toggle { margin: 0 auto; display: block; }
    #ffd-root .sidebar.collapsed .nav-item { border-right: none; }
    #ffd-root .sidebar.collapsed .nav-item.on { border-right: 2px solid var(--accent); }
    #ffd-root .sidebar-footer-note { font-size: 10px; color: var(--text4); }

    /* ── Main content area ── */
    #ffd-root .main { flex: 1; min-width: 0; padding: 20px;min-height: 100vh; }
    #ffd-root .main-hdr { display: flex; flex-direction: column; gap: 8px; margin: 0 0 1.25rem; }
    #ffd-root .main-hdr-row1 { display: flex; align-items: center; justify-content: space-between; gap: 8px; flex-wrap: wrap; }
    #ffd-root .main-hdr-row2 { display: flex; align-items: stretch; }
    #ffd-root .hdr-stats { display: flex; align-items: stretch; gap: 0; width: 100%; border: 1px solid var(--border); border-radius: 10px; background: var(--bg2); }
    #ffd-root .hdr-stat { display: flex; flex-direction: column; justify-content: center; padding: 8px 18px; border-right: 1px solid var(--border); cursor: default; position: relative; min-width: 0; flex: 1; }
    #ffd-root .hdr-stat:last-child { border-right: none; border-radius: 0 10px 10px 0; }
    #ffd-root .hdr-stat:first-child { border-radius: 10px 0 0 10px; }
    #ffd-root .hdr-stat:hover { background: var(--bg3); }
    #ffd-root .hdr-stat-lbl { font-size: 10px; color: var(--text4); font-weight: 500; white-space: nowrap; margin-bottom: 2px; text-transform: uppercase; letter-spacing: .04em; }
    #ffd-root .hdr-stat-val { font-size: 13px; font-weight: 700; color: var(--text); white-space: nowrap; }
    #ffd-root .hdr-stat-tooltip { display: none; position: absolute; top: calc(100% + 8px); left: 50%; transform: translateX(-50%); background: var(--card-bg); border: 1px solid var(--border); border-radius: 10px; padding: 10px 14px; font-size: 11px; line-height: 1.7; z-index: 999; white-space: nowrap; box-shadow: 0 8px 24px rgba(0,0,0,.13); }
    #ffd-root .hdr-stat:hover .hdr-stat-tooltip { display: block; }
    #ffd-root .hdr-stat:has(.hdr-stat-tooltip) .hdr-stat-lbl::after { content: ' \B7\B7\B7'; font-size: 9px; color: var(--text4); vertical-align: middle; margin-left: 2px; letter-spacing: 1px; }
    #ffd-root .hdr-stat:has(.hdr-stat-tooltip):hover .hdr-stat-lbl::after { color: var(--accent); }
    #ffd-root .alarm-banner { display: none; padding: .65rem 1rem; border-radius: 8px; margin: 0 0 .75rem; font-size: 13px; font-weight: 600; gap: 8px; align-items: center; flex-wrap: wrap; }
    #ffd-root .cd-chip { display: flex; align-items: center; gap: 8px; padding: .6rem 1rem; border-radius: 10px; font-size: 13px; border: 1px solid var(--border); background: var(--bg2); flex: 1; min-width: 180px; }
    #ffd-root .cd-chip.urgent { background: var(--err-bg); border-color: var(--err-border); }
    #ffd-root .cd-chip.warn { background: var(--warn-bg); border-color: var(--warn-border); }
    #ffd-root .cd-days { font-size: 22px; font-weight: 800; min-width: 2.5rem; text-align: center; }
    #ffd-root .cd-info { display: flex; flex-direction: column; gap: 1px; }
    #ffd-root .cd-name { font-weight: 600; font-size: 13px; }
    #ffd-root .cd-meta { font-size: 11px; color: var(--text3); }
    #ffd-root .alarm-banner.show { display: flex; }
    #ffd-root .alarm-banner.warn { background: var(--warn-bg); color: var(--warn); border: 1px solid var(--warn-border); }
    #ffd-root .alarm-banner.crit { background: var(--err-bg); color: var(--err); border: 1px solid var(--err-border); }
    #ffd-root .main-title { font-size: 17px; font-weight: 700; color: var(--text); }

    #ffd-root .ov-grp-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    /* Tool tab outer grids (card columns) */
    #ffd-root .mobile-footer-end { display: none; }
    @media (max-width: 639px) {
      #ffd-root .mobile-footer-end {
        display: block;
        text-align: center;
        font-size: 10px;
        color: var(--text4);
        padding: 1.25rem 1rem 1.5rem;
        border-top: 1px solid var(--border);
        margin-top: 1rem;
        line-height: 1.8;
      }
      #ffd-root .mobile-footer-end a { text-decoration: none; color: var(--text3); }
    }
    #ffd-root .tool-tab { display: none; grid-template-columns: 1fr 1fr; gap: 1rem; align-items: start; }
    #ffd-root .tool-tab.on { display: grid; align-items: stretch; }
    /* Inner field grids inside tool cards */
    #ffd-root .tg2 { display: grid; grid-template-columns: 1fr 1fr; gap: .75rem; }
    #ffd-root .tg3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: .75rem; }
    /* ── Hide old horizontal tabs on wider screens ── */
    @media (min-width: 640px) {
      #ffd-root .tabs { display: none; }
    }
    /* ── On mobile: hide sidebar, show tabs ── */
    @media (max-width: 639px) {
      #ffd-root .sidebar { display: none; }
      #ffd-root .layout { display: block; }
      #ffd-root .main { padding: 1rem; margin-left: 0 !important; }
      #ffd-root .tabs { display: flex; }
    }

    /* ═══════════════════════════════════════════
       RESPONSIVE BREAKPOINTS
       639px  = mobile  (phones)
       899px  = tablet  (small tablets / landscape phones)
    ═══════════════════════════════════════════ */

    /* ── Tablet: chart pairs stay 2-col but tool fields stack ── */
    @media (max-width: 899px) {
      #ffd-root .main-hdr-row2 { overflow-x: auto; }
      #ffd-root .hdr-stats { min-width: max-content; }
      #ffd-root .tg3 { grid-template-columns: 1fr 1fr; }
      #ffd-root .ov-grp-grid { grid-template-columns: 1fr; }
    }

    /* ══════════════════════════════════════
       MOBILE  (≤ 639px)
    ══════════════════════════════════════ */
    @media (max-width: 639px) {

      /* ── Layout ── */
      #ffd-root .sidebar { display: none; }
      #ffd-root .layout  { display: block; }
      #ffd-root .main    { padding: 1rem; margin-left: 0 !important; }
      #ffd-root .tabs    { display: flex; }

      /* ── Header ── */
      #ffd-root .main-hdr-row1   { gap: 6px; }
      #ffd-root .main-title      { font-size: 15px; }
      #ffd-root .hdr-stat        { padding: 6px 10px; }
      #ffd-root .hdr-stat-val    { font-size: 12px; }
      #ffd-root .pills           { flex-wrap: wrap; }
      #ffd-root #pills-bar       { flex-wrap: wrap; gap: 4px; }
      #ffd-root #pills-btc-fiats { flex-wrap: wrap; }
      #ffd-root .pill input      { width: 70px; }
      #ffd-root #cg-ratelimit-msg { white-space: normal !important; }

      /* ── Section spacing ── */
      #ffd-root .sh { font-size: 11px; margin-bottom: .5rem; }
      #ffd-root .mt { margin-top: 1rem; }

      /* ── Overview grids ── */
      #ffd-root .ov-grp-grid { grid-template-columns: 1fr; }
      #ffd-root .grp-inner   { grid-template-columns: 1fr 1fr; }

      /* ── General card / metric grids ── */
      #ffd-root .mg { grid-template-columns: 1fr; }
      #ffd-root .fg { grid-template-columns: 1fr; }
      #ffd-root .mc { word-break: break-word; }
      #ffd-root .mc-val { font-size: 15px; }

      /* ── Loan cards ── */
      #ffd-root #loans-list { grid-template-columns: 1fr; }
      #ffd-root .lmeta                        { grid-template-columns: 1fr 1fr; }
      #ffd-root .lmeta[style*="1fr 1fr 1fr"]  { grid-template-columns: 1fr 1fr !important; }
      #ffd-root .lmeta[style*="margin-top"]   { grid-template-columns: 1fr 1fr !important; }

      /* ── Loans table ── */
      #ffd-root .ovx         { overflow-x: auto; -webkit-overflow-scrolling: touch; }
      #ffd-root .loans-table { min-width: 580px; }

      /* ── Tools ── */
      #ffd-root .tool-tab          { grid-template-columns: 1fr; }
      #ffd-root .tg2, #ffd-root .tg3 { grid-template-columns: 1fr; }
      #ffd-root .tr                { flex-direction: column; align-items: flex-start; gap: 4px; }
      #ffd-root .tr label          { min-width: unset; }
      #ffd-root .tr input,
      #ffd-root .tr select         { width: 100%; }

      /* ── Charts ── */
      #ffd-root .ch-wrap           { height: 180px; }
      #ffd-root [style*="height:300px"],
      #ffd-root [style*="height:320px"],
      #ffd-root [style*="height:340px"] { height: 200px !important; }
      /* Gantt: tighter label columns */
      #ffd-root #ch-gantt [style*="width:90px"] { width: 60px !important; min-width: 60px !important; }
      #ffd-root #ch-gantt [style*="width:70px"] { width: 50px !important; min-width: 50px !important; }

      /* ── Calendar ── */
      #ffd-root .cg      { font-size: 10px; }
      #ffd-root .cal-day { padding: 2px; min-height: 28px; }

      /* ── Countdown chips ── */
      #ffd-root .cd-chip { min-width: 0; flex: 1 1 140px; }

      /* ── Filter tabs ── */
      #ffd-root .filter-tabs        { overflow-x: auto; flex-wrap: nowrap; }
      #ffd-root .filter-tabs button { flex-shrink: 0; }

      /* ── fxsb rows ── */
      #ffd-root .fxsb { flex-wrap: wrap; gap: 6px; }

      /* ── Stress-test: worst-case 4-col → 2×2 ── */
      #ffd-root #wc-r [style*="repeat(4,1fr)"] { grid-template-columns: 1fr 1fr !important; }

      /* ── Stat mini-tiles ── */
      #ffd-root .stats { gap: 5px; }
      #ffd-root .stat  { min-width: 65px; }

      /* ── Modals ── */
      #ffd-root .modal-bg     { align-items: flex-end; padding: 0; }
      #ffd-root .modal        { padding: 1rem; border-radius: 12px 12px 0 0; max-height: 90vh; max-width: 100% !important; }
      #ffd-root .modal-actions { flex-wrap: wrap; }

      /* ── Settings danger zone ── */
      #ffd-root #s-se [style*="justify-content:space-between"][style*="align-items:center"] {
        flex-direction: column; align-items: flex-start !important; gap: .5rem;
      }
      #ffd-root #s-se [style*="justify-content:space-between"][style*="align-items:center"] button {
        margin-left: 0 !important; width: 100%;
      }

      /* ── Inline repeat grids in JS output ── */
      #ffd-root .card > div[style*="repeat(3"] { grid-template-columns: 1fr 1fr !important; }
      #ffd-root .card > div[style*="repeat(4"] { grid-template-columns: 1fr 1fr !important; }
    }
    </style>

    <div class="layout">

    <!-- SIDEBAR -->
    <div class="sidebar">
      <div class="sidebar-logo" style="display:flex;align-items:center;justify-content:space-between">
        <div class="sidebar-logo-icon"><img src="logo-bitcoin.png" alt="Logo" class="logo-img" style="width:20px;height:20px;object-fit:contain;display:block;"></div>
        <span class="sidebar-logo-text">Dashboard für Firefish</span>
        <button class="sidebar-toggle" onclick="d.toggleSidebar()" title="Sidebar ein-/ausklappen">&#9776;</button>
      </div>
      <span class="nav-section">Navigation</span>
      <button class="nav-item on" onclick="d.tab('ov',this)">
        <svg class="nav-icon" viewBox="0 0 16 16" fill="currentColor"><rect x="1" y="1" width="6" height="6" rx="1"/><rect x="9" y="1" width="6" height="6" rx="1"/><rect x="1" y="9" width="6" height="6" rx="1"/><rect x="9" y="9" width="6" height="6" rx="1"/></svg>
        <span>&#220;bersicht</span>
      </button>
      <button class="nav-item" onclick="d.tab('lo',this)">
        <svg class="nav-icon" viewBox="0 0 16 16" fill="currentColor"><path d="M2 4h12v1.5H2V4zm0 3.5h12V9H2V7.5zm0 3.5h8v1.5H2V11z"/></svg>
        <span>Meine Kredite</span>
      </button>
      <button class="nav-item" onclick="d.tab('ch',this)">
        <svg class="nav-icon" viewBox="0 0 16 16" fill="currentColor"><path d="M1 11a1 1 0 011-1h2a1 1 0 011 1v3a1 1 0 01-1 1H2a1 1 0 01-1-1v-3zm5-4a1 1 0 011-1h2a1 1 0 011 1v7a1 1 0 01-1 1H7a1 1 0 01-1-1V7zm5-5a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V2z"/></svg>
        <span>Diagramme</span>
      </button>
      <button class="nav-item" onclick="d.tab('sx',this)">
        <svg class="nav-icon" viewBox="0 0 16 16" fill="currentColor"><path d="M0 0h1v16H0zm15 0h1v16h-1zm-5 5h1v1h-1zm-2 0h1v1H8zm-2 0h1v1H6zM4 5h1v1H4zm6 2h1v1h-1zm-2 0h1v1H8zm-2 0h1v1H6zm-2 0h1v1H4zm6 2h1v1h-1zm-2 0h1v1H8zm-2 0h1v1H6zm-2 0h1v1H4z"/></svg>
        <span>Statistiken</span>
      </button>
      <button class="nav-item" onclick="d.tab('ca',this)">
        <svg class="nav-icon" viewBox="0 0 16 16" fill="currentColor"><path d="M11 6.5a.5.5 0 01.5-.5h1a.5.5 0 01.5.5v1a.5.5 0 01-.5.5h-1a.5.5 0 01-.5-.5v-1zm-3 0a.5.5 0 01.5-.5h1a.5.5 0 01.5.5v1a.5.5 0 01-.5.5h-1a.5.5 0 01-.5-.5v-1zm-5 3a.5.5 0 01.5-.5h1a.5.5 0 01.5.5v1a.5.5 0 01-.5.5h-1a.5.5 0 01-.5-.5v-1zm3 0a.5.5 0 01.5-.5h1a.5.5 0 01.5.5v1a.5.5 0 01-.5.5h-1a.5.5 0 01-.5-.5v-1z"/><path d="M3.5 0a.5.5 0 01.5.5V1h8V.5a.5.5 0 011 0V1h1a2 2 0 012 2v11a2 2 0 01-2 2H2a2 2 0 01-2-2V3a2 2 0 012-2h1V.5a.5.5 0 01.5-.5zM1 4v10a1 1 0 001 1h12a1 1 0 001-1V4H1z"/></svg>
        <span>Kalender</span>
      </button>
      <button class="nav-item" onclick="d.tab('tl',this)">
        <svg class="nav-icon" viewBox="0 0 16 16" fill="currentColor"><path d="M5 3.5h6A.5.5 0 0111 4v1H5V4a.5.5 0 01.5-.5zM2.5 5A.5.5 0 002 5.5v1a.5.5 0 00.5.5h11a.5.5 0 00.5-.5v-1a.5.5 0 00-.5-.5h-11zm1 3a.5.5 0 00-.5.5v1a.5.5 0 00.5.5h9a.5.5 0 00.5-.5v-1a.5.5 0 00-.5-.5h-9zm1 3a.5.5 0 00-.5.5v1a.5.5 0 00.5.5h7a.5.5 0 00.5-.5v-1a.5.5 0 00-.5-.5h-7z"/></svg>
        <span>Timeline</span>
      </button>
      <button class="nav-item" onclick="d.tab('ro',this)">
        <svg class="nav-icon" viewBox="0 0 16 16" fill="currentColor"><path d="M11.534 7h3.932a.25.25 0 01.192.41l-1.966 2.36a.25.25 0 01-.384 0l-1.966-2.36a.25.25 0 01.192-.41zm-11 2h3.932a.25.25 0 00.192-.41L2.692 6.23a.25.25 0 00-.384 0L.342 8.59A.25.25 0 00.534 9z"/><path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 11-.771-.636A6.002 6.002 0 0115.917 9h-.997A5.002 5.002 0 008 3zM3.083 9a5.002 5.002 0 009.895 1.183.5.5 0 01.98.199A6.003 6.003 0 011.083 9H3.08z"/></svg>
        <span>Roll-Overs</span>
      </button>
      <button class="nav-item" onclick="d.tab('st',this)">
        <svg class="nav-icon" viewBox="0 0 16 16" fill="currentColor"><path d="M8 15A7 7 0 108 1a7 7 0 000 14zm0 1A8 8 0 118 0a8 8 0 010 16z"/><path d="M8 4a.5.5 0 01.5.5v3.793l2.146 2.147a.5.5 0 01-.708.707L7.5 8.793V4.5A.5.5 0 018 4z"/></svg>
        <span>Stress-Test</span>
      </button>
      <button class="nav-item" onclick="d.tab('to',this)">
        <svg class="nav-icon" viewBox="0 0 16 16" fill="currentColor"><path d="M12 1a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V2a1 1 0 011-1h8zM4 0a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V2a2 2 0 00-2-2H4z"/><path d="M4 2.5a.5.5 0 01.5-.5h7a.5.5 0 01.5.5v2a.5.5 0 01-.5.5h-7a.5.5 0 01-.5-.5v-2zm1 4a.5.5 0 100 1 .5.5 0 000-1zm2.5.5a.5.5 0 111 0 .5.5 0 01-1 0zm2.5-.5a.5.5 0 100 1 .5.5 0 000-1zM5 9.5a.5.5 0 111 0 .5.5 0 01-1 0zm2.5-.5a.5.5 0 100 1 .5.5 0 000-1zm2.5.5a.5.5 0 111 0 .5.5 0 01-1 0zM5 12a.5.5 0 100 1 .5.5 0 000-1zm2.5.5a.5.5 0 111 0 .5.5 0 01-1 0zm2.5-.5a.5.5 0 100 1 .5.5 0 000-1z"/></svg>
        <span>Tools</span>
      </button>
      <div class="nav-spacer" style="flex:1"></div>
      <button class="nav-item" data-nav-fixed onclick="d.tab('se',this)" style="border-top:1px solid var(--border);margin-top:4px">
        <svg class="nav-icon" viewBox="0 0 16 16" fill="currentColor"><path d="M11.5 2a1.5 1.5 0 100 3 1.5 1.5 0 000-3zM9.05 3a2.5 2.5 0 014.9 0H16v1h-2.05a2.5 2.5 0 01-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 100 3 1.5 1.5 0 000-3zM2.05 8a2.5 2.5 0 014.9 0H16v1H6.95a2.5 2.5 0 01-4.9 0H0V8h2.05zM11.5 12a1.5 1.5 0 100 3 1.5 1.5 0 000-3zm-2.45 1a2.5 2.5 0 014.9 0H16v1h-2.05a2.5 2.5 0 01-4.9 0H0v-1h9.05z"/></svg>
        <span>Einstellungen</span>
      </button>
      <div class="sidebar-footer">
        <span class="sidebar-footer-note">Firefish Dashboard <a href="https://github.com/thesatoshivan/firefish-dashboard-unofficial/blob/main/changelog.md#v130-22032026" target="_blank" style="text-decoration:none;color:var(--text3)">v1.3.0</a><br>Inoffizielles Tool — nicht verbunden mit firefish.io<br><a href="https://github.com/thesatoshivan" target="_blank" style="text-decoration:none;color:var(--text3)">🔗 GitHub</a><br><a href="https://x.com/TheSatoshiVan" target="_blank" style="text-decoration:none;color:var(--text3)">𝕏 @TheSatoshiVan</a></span>
      </div>
    </div>

    <!-- MAIN -->
    <div class="main">

    <!-- Header: Pills + Actions (Row 1) · Stats bar (Row 2) -->
    <div class="main-hdr">
      <div class="main-hdr-row1">
        <div class="pills" id="pills-bar">
          <button class="sm" id="btc-refresh-btn" onclick="d.refreshBtc()" title="Bitcoinkurs aktualisieren" style="font-size:15px;padding:2px 8px">↻</button>
          <span class="pill">BTC/USD<input type="number" id="p-btc" title="BTC/USD bearbeiten" oninput="d.rate()" step="1"></span>
          <span class="pill">EUR/USD <input type="number" id="p-eur" title="EUR/USD bearbeiten" oninput="d.rate()" step="0.001"></span>
          <span class="pill">CHF/USD <input type="number" id="p-chf" title="CHF/USD bearbeiten" oninput="d.rate()" step="0.001"></span>
          <span class="pill">USDT <b>&#8776; 1.00</b></span>
          <span id="pills-btc-fiats" class="pills"></span>
        </div>
        <div style="display:flex;gap:6px;align-items:center;flex-wrap:wrap">
          <span id="cg-ratelimit-msg" style="display:none;font-size:11px;font-weight:600;color:var(--warn);background:var(--warn-bg);border:1px solid var(--warn-border);border-radius:8px;padding:3px 10px;white-space:nowrap">⚠ CoinGecko Rate-Limit — Bitte in einigen Minuten neu laden.</span>
          <button class="sm" onclick="d.toggleDark()" id="dark-btn" title="Dunkelmodus">&#9790;</button>
          <button class="sm" onclick="d.toggleHideAmounts()" id="hide-btn" title="Betr&#228;ge ausblenden">&#128065;</button>
        </div>
      </div>
      <div class="main-hdr-row2">
        <div class="hdr-stats" id="hdr-stats-bar">
          <div class="hdr-stat">
            <span class="hdr-stat-lbl">Aktive Kredite</span>
            <span class="hdr-stat-val" id="hdr-act-count">&#8213;</span>
          </div>
          <div class="hdr-stat">
            <span class="hdr-stat-lbl">N&#228;chste F&#228;lligkeit</span>
            <span class="hdr-stat-val" id="hdr-next-due">&#8213;</span>
            <div class="hdr-stat-tooltip" id="hdr-next-due-tooltip"></div>
          </div>
          <div class="hdr-stat">
            <span class="hdr-stat-lbl">Offene Schuld</span>
            <span class="hdr-stat-val" id="hdr-due-val">&#8213;</span>
            <div class="hdr-stat-tooltip" id="hdr-due-tooltip"></div>
          </div>
          <div class="hdr-stat">
            <span class="hdr-stat-lbl">Offene Schuld (BTC)</span>
            <span class="hdr-stat-val" id="hdr-due-btc">&#8213;</span>
          </div>
          <div class="hdr-stat">
            <span class="hdr-stat-lbl">Hinterlegtes Collateral</span>
            <span class="hdr-stat-val" id="hdr-col-btc">&#8213;</span>
          </div>
          <div class="hdr-stat">
            <span class="hdr-stat-lbl">Collateral-Wert</span>
            <span class="hdr-stat-val" id="hdr-col-val">&#8213;</span>
            <div class="hdr-stat-tooltip" id="hdr-col-tooltip"></div>
          </div>
          <div class="hdr-stat">
            <span class="hdr-stat-lbl">Distanz nächster MC</span>
            <span class="hdr-stat-val" id="hdr-mc1-dist">&#8213;</span>
            <div class="hdr-stat-tooltip" id="hdr-mc1-tooltip"></div>
          </div>
          <div class="hdr-stat">
            <span class="hdr-stat-lbl">Break-even BTC</span>
            <span class="hdr-stat-val" id="hdr-bep">&#8213;</span>
            <div class="hdr-stat-tooltip" id="hdr-bep-tooltip"></div>
          </div>
          <div class="hdr-stat">
            <span class="hdr-stat-lbl">BTC 24h</span>
            <span class="hdr-stat-val" id="hdr-btc-24h">&#8213;</span>
          </div>
        </div>
      </div>
    </div>
    <hr style="border:none;border-top:1px solid var(--border);margin:0 0 1.25rem">

    <!-- TABS (mobile fallback) -->
    <div class="tabs">
      <button class="tab on" onclick="d.tab('ov',this)">&#220;bersicht</button>
      <button class="tab" onclick="d.tab('lo',this)">Meine Kredite</button>
      <button class="tab" onclick="d.tab('to',this)">Tools</button>
      <button class="tab" onclick="d.tab('st',this)">Stress-Test</button>
      <button class="tab" onclick="d.tab('ca',this)">Kalender</button>
      <button class="tab" onclick="d.tab('tl',this)">Timeline</button>
      <button class="tab" onclick="d.tab('ch',this)">Diagramme</button>
      <button class="tab" onclick="d.tab('sx',this)">Statistiken</button>
      <button class="tab" onclick="d.tab('ro',this)">Roll-Overs</button>
      <button class="tab" onclick="d.tab('se',this)">&#9881; Einstellungen</button>
    </div>
    <div class="sec on" id="s-ov">
    <div class="alarm-banner" id="alarm-banner"></div>
    <div id="next-action-widget" style="margin-bottom:.75rem"></div>
      <div class="mg" id="metrics"></div>
      <span class="sh">Gesamtschulden — alle Währungen</span>
      <div class="card"><div id="ov-multi"></div></div>
      <div class="fxsb" style="margin-top:1.5rem;margin-bottom:.5rem;align-items:center">
        <span class="sh" style="margin:0">Aktive Kredite — LTV &amp; Umrechnung</span>
        <div style="display:flex;align-items:center;gap:6px;font-size:12px;color:var(--text3)">
          <label for="ltv-thresh-input" style="white-space:nowrap">Anzeigen ab LTV</label>
          <input type="number" id="ltv-thresh-input" min="0" max="100" step="1"
            style="width:56px;padding:3px 6px;font-size:12px;border:1px solid var(--border);border-radius:6px;background:var(--bg2);color:var(--text);text-align:center"
            oninput="d.setLtvThresh(this.value)">
          <span>%</span>
        </div>
      </div>
      <div id="ov-ltv" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(340px,1fr));gap:1rem"></div>
    </div>

    <!-- ── LOANS ── -->
    <div class="sec" id="s-lo">
      <div class="fxsb mb">
        <span class="sh" style="margin:0">Alle Kredite</span>
        <div class="fx">
          <button class="sm" onclick="d.exportJSON()">&#8595; JSON</button>
          <button class="sm" onclick="d.exportCSV()">&#8595; CSV</button>
          <button class="sm" onclick="d.openImport('json')">&#8593; JSON</button>
          <button class="sm" onclick="d.openImport('csv')">&#8593; CSV</button>
          <input type="file" id="import-file-json" accept=".json" style="position:absolute;width:0;height:0;opacity:0;overflow:hidden;pointer-events:none" onchange="d.importJSON(this)">
          <input type="file" id="import-file-csv" accept=".csv" style="position:absolute;width:0;height:0;opacity:0;overflow:hidden;pointer-events:none" onchange="d.importCSV(this)">
          <button class="primary sm" onclick="d.togAdd()">+ Kredit hinzuf&#252;gen</button>
        </div>
      </div>
      <div id="import-msg" style="display:none;margin:0 0 .75rem;font-size:13px;padding:.5rem .75rem;border-radius:8px"></div>
      <div style="display:flex;align-items:center;gap:6px;flex-wrap:wrap;margin:0 0 .9rem">
        <span style="font-size:12px;color:var(--text4);margin-right:2px">Sortieren:</span>
        <button class="sort-btn" data-key="start" data-label="Datum" onclick="d.sortBy('start',this)">Datum</button>
        <button class="sort-btn" data-key="status" data-label="Status" onclick="d.sortBy('status',this)">Status</button>
        <button class="sort-btn" data-key="amount" data-label="Betrag" onclick="d.sortBy('amount',this)">Betrag</button>
        <button class="sort-btn" data-key="rate" data-label="Zinssatz" onclick="d.sortBy('rate',this)">Zinssatz</button>
        <button class="sort-btn" data-key="term" data-label="Laufzeit" onclick="d.sortBy('term',this)">Laufzeit</button>
        <button class="sort-btn on" data-key="dl" data-label="Fälligkeit" onclick="d.sortBy('dl',this)">Fälligkeit ↑</button>
        <button class="sort-btn" data-key="interest" data-label="Zinsen" onclick="d.sortBy('interest',this)">Zinsen</button>
        <button class="sort-btn" data-key="due" data-label="Fälliger Betrag" onclick="d.sortBy('due',this)">Fälliger Betrag</button>
        <button class="sort-btn" data-key="col" data-label="Collateral" onclick="d.sortBy('col',this)">Collateral</button>
        <button class="sort-btn" data-key="ltv" data-label="LTV" onclick="d.sortBy('ltv',this)">LTV</button>
        <button class="sort-btn" data-key="liq" data-label="Liquidation" onclick="d.sortBy('liq',this)">Liquidation</button>
      </div>
      <div style="display:flex;align-items:center;justify-content:space-between;margin:0 0 1rem;flex-wrap:wrap;gap:.5rem">
        <div style="display:flex;align-items:center;gap:.5rem;flex-wrap:wrap">
          <div class="filter-tabs" style="margin:0;border-bottom:none">
            <button id="ft-all" class="filter-tab" onclick="d.filterLoans('all',this)">Alle</button>
            <button id="ft-active" class="filter-tab on" onclick="d.filterLoans('active',this)">Aktiv</button>
            <button id="ft-closed" class="filter-tab" onclick="d.filterLoans('closed',this)">Abgeschlossen</button>
          </div>
          <div id="ccy-filter-bar" style="display:none;gap:6px;flex-wrap:wrap"></div>
        </div>
        <div class="view-toggle">
          <button class="view-btn on" id="view-grid-btn" onclick="d.setView('grid',this)" title="Kachelansicht">&#9783;</button>
          <button class="view-btn" id="view-list-btn" onclick="d.setView('list',this)" title="Listenansicht">&#9776;</button>
        </div>
      </div>
      <div class="add-panel" id="add-panel" style="display:none">
        <span class="add-title">Neuer Kredit</span>
        <div class="fg">
          <div class="ff"><label>Bezeichnung</label><input type="text" id="fn" placeholder="Kredit #X"></div>
          <div class="ff"><label>ID <span style="font-size:11px;font-weight:400;color:var(--text4)">(optional — wird automatisch generiert)</span></label><input type="text" id="fid" placeholder="z.B. abc12345" style="font-family:monospace"></div>
          <div class="ff"><label>Betrag</label><input type="number" id="fa" placeholder="10000"></div>
          <div class="ff"><label>Zinssatz (% p.a.)</label><input type="number" id="fr" placeholder="8" step="0.1"></div>
          <div class="ff"><label>Gebühr (BTC, einmalig)</label><input type="number" id="ffee" placeholder="0" step="0.0001" min="0"></div>
          <div class="ff"><label>Laufzeit (Monate)</label><select id="ft"><option>3</option><option>6</option><option selected>12</option><option>18</option><option>24</option></select></div>
          <div class="ff"><label>Startdatum</label><input type="date" id="fd" onchange="d.autoFillBtcStart('fd','fbp','fbp-hint')"></div>
          <div class="ff"><label>Collateral (BTC)</label><input type="number" id="fb" placeholder="0.25" step="0.001"></div>
          <div class="ff"><label>Status</label><select id="fs"><option value="active">Aktiv</option><option value="closed">Abgeschlossen</option></select></div>
          <div class="ff"><label>Währung</label><select id="fc"><option>EUR</option><option>CHF</option><option>CZK</option><option>PLN</option><option>USDC</option><option>USDT</option></select></div>
          <div class="ff" style="grid-column:span 2"><label>BTC-Preis bei Kreditaufnahme (USD) — für Break-even</label><input type="number" id="fbp" placeholder="z.B. 85000" step="1"><span id="fbp-hint" style="display:none;font-size:11px;color:var(--text4);margin-top:3px"></span></div>
          <div class="ff" style="grid-column:span 2"><label>Roll-Over-Kette</label><select id="fchain"><option value="">— Keine Kette —</option></select><span style="font-size:11px;color:var(--text4);margin-top:3px;display:block">Vorläufer-Kredit wählen oder neue Kette starten</span></div>
          <div class="ff" style="grid-column:span 2"><label>Notiz</label><textarea id="fnote" rows="2" placeholder="Konditionen, Kontaktperson, Besonderheiten…" style="width:100%;padding:6px 8px;border:1px solid var(--border);border-radius:8px;background:var(--bg);color:var(--text);font-size:13px;resize:vertical;font-family:inherit"></textarea></div>
        </div>
        <div class="fa">
          <button class="sm" onclick="d.togAdd()">Abbrechen</button>
          <button class="primary sm" onclick="d.addLoan()">Speichern</button>
        </div>
      </div>
      <div id="loans-list"></div>
    </div>

    <!-- ── TOOLS ── -->
    <div class="sec" id="s-to" style="display:none;flex-direction:column;gap:0">
      <!-- Globaler Währungs-Select -->
      <div style="display:flex;align-items:center;gap:.75rem;padding:.6rem 1rem;background:var(--bg2);border-radius:10px;border:1px solid var(--border);margin-bottom:.75rem">
        <span style="font-size:13px;font-weight:600;color:var(--text2)">W&#228;hrung f&#252;r alle Tools:</span>
        <select id="vor-ccy" onchange="d.vorCcyChange()" style="width:110px;font-weight:600"></select>
        <span style="font-size:12px;color:var(--text4)">Bitcoin-Preis: <b id="vor-btc-display">—</b></span>
      </div>
      <!-- Tool Sub-Tabs -->
      <div class="filter-tabs" style="margin-bottom:1.25rem">
        <button class="filter-tab on" onclick="d.toolTab('vor',this)">Vor Kredit</button>
        <button class="filter-tab" onclick="d.toolTab('wae',this)">W&#228;hrend Kredit</button>
        <button class="filter-tab" onclick="d.toolTab('nach',this)">Nach Kredit</button>
        <button class="filter-tab" onclick="d.toolTab('pow',this)">Powerlaw</button>
        <button class="filter-tab" onclick="d.toolTab('rosi',this)">Roll-Over Simulation</button>
        <button class="filter-tab" onclick="d.toolTab('zukunft',this)">Zukunftssimulation</button>
      </div>

      <!-- Vor Kredit -->
      <div class="tool-tab on" id="tt-vor">

        <!-- 1. Maximaler Kreditbetrag -->
        <div class="card">
          <span class="card-title">Maximaler Kreditbetrag</span>
          <p class="note2" style="margin-bottom:.75rem">Welchen max. Kreditbetrag erhalte ich f&#252;r meine Bitcoin?</p>
          <div class="tg2">
            <div class="vor-field"><label id="mkb-btc-lbl">Aktueller Bitcoin-Preis (USD)</label><input type="number" id="mkb-btc" placeholder="71549" oninput="d.mkb()"></div>
            <div class="vor-field"><label id="mkb-wert-lbl">Wert der Bitcoin ohne Reserve (USD)</label><input type="text" id="mkb-wert" placeholder="—" readonly style="background:var(--bg2);color:var(--text3)"></div>
            <div class="vor-field"><label>Gesamte Bitcoin im Besitz</label><input type="number" id="mkb-btcanz" placeholder="0.20" step="0.001" oninput="d.mkb()"></div>
            <div class="vor-field"><label>Bitcoin als Reserve behalten (optional)</label><input type="number" id="mkb-res" placeholder="0.10" step="0.001" oninput="d.mkb()"></div>
            <div class="vor-field">
              <label>Kreditlaufzeit</label>
              <div style="display:flex;flex-wrap:wrap;gap:.4rem .75rem;margin-top:.35rem">
                <label style="font-weight:400;font-size:13px;display:inline-flex;align-items:center;gap:.3rem;white-space:nowrap"><input type="radio" name="mkb-term" value="3" onchange="d.mkb()"> 3 Monate</label>
                <label style="font-weight:400;font-size:13px;display:inline-flex;align-items:center;gap:.3rem;white-space:nowrap"><input type="radio" name="mkb-term" value="6" onchange="d.mkb()"> 6 Monate</label>
                <label style="font-weight:400;font-size:13px;display:inline-flex;align-items:center;gap:.3rem;white-space:nowrap"><input type="radio" name="mkb-term" value="12" checked onchange="d.mkb()"> 12 Monate</label>
                <label style="font-weight:400;font-size:13px;display:inline-flex;align-items:center;gap:.3rem;white-space:nowrap"><input type="radio" name="mkb-term" value="18" onchange="d.mkb()"> 18 Monate</label>
                <label style="font-weight:400;font-size:13px;display:inline-flex;align-items:center;gap:.3rem;white-space:nowrap"><input type="radio" name="mkb-term" value="24" onchange="d.mkb()"> 24 Monate</label>
              </div>
            </div>
            <div class="vor-field"><label>Zinssatz (%)</label><input type="number" id="mkb-rate" placeholder="10" step="0.1" oninput="d.mkb()"><br><input type="range" id="mkb-rate-sl" min="0" max="20" step="0.1" value="10" style="width:100%;margin-top:.35rem" oninput="document.getElementById('mkb-rate').value=parseFloat(this.value);document.getElementById('mkb-rate-lbl').textContent=parseFloat(this.value)+' %';d.mkb()"><span id="mkb-rate-lbl" style="font-size:11px;color:var(--text4)">10.0 %</span></div>
            <div class="vor-field"><label id="mkb-zinsen-lbl">Zinsen (USD)</label><input type="text" id="mkb-zinsen" placeholder="—" readonly style="background:var(--bg2);color:var(--text3)"></div>
          </div>
          <div style="margin-top:.75rem;padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
            <label id="mkb-result-lbl" style="font-size:12px;font-weight:600">Maximaler Kreditbetrag inkl. Bearbeitungsgeb&#252;hr (USD)</label>
            <div id="mkb-result" style="font-size:18px;font-weight:700;color:var(--accent);margin-top:.25rem">—</div>
          </div>
        </div>

        <!-- 2. Sicherheit zu Beginn -->
        <div class="card">
          <span class="card-title">Sicherheit zu Beginn</span>
          <p class="note2" style="margin-bottom:.75rem">Welche Bitcoinmenge muss ich als Sicherheit hinterlegen?</p>
          <div class="tg2">
            <div class="vor-field"><label id="szb-loan-lbl">Kreditbetrag (USD)</label><input type="number" id="szb-loan" placeholder="10000" oninput="d.szb()"></div>
            <div class="vor-field"><label id="szb-zinsen-lbl">Zinsen (USD)</label><input type="number" id="szb-zinsen" placeholder="1000" oninput="d.szb()"></div>
            <div class="vor-field">
              <label>Kreditlaufzeit</label>
              <div style="display:flex;flex-wrap:wrap;gap:.4rem .75rem;margin-top:.35rem">
                <label style="font-weight:400;font-size:13px;display:inline-flex;align-items:center;gap:.3rem;white-space:nowrap"><input type="radio" name="szb-term" value="3" onchange="d.szb()"> 3 Monate</label>
                <label style="font-weight:400;font-size:13px;display:inline-flex;align-items:center;gap:.3rem;white-space:nowrap"><input type="radio" name="szb-term" value="6" onchange="d.szb()"> 6 Monate</label>
                <label style="font-weight:400;font-size:13px;display:inline-flex;align-items:center;gap:.3rem;white-space:nowrap"><input type="radio" name="szb-term" value="12" checked onchange="d.szb()"> 12 Monate</label>
                <label style="font-weight:400;font-size:13px;display:inline-flex;align-items:center;gap:.3rem;white-space:nowrap"><input type="radio" name="szb-term" value="18" onchange="d.szb()"> 18 Monate</label>
                <label style="font-weight:400;font-size:13px;display:inline-flex;align-items:center;gap:.3rem;white-space:nowrap"><input type="radio" name="szb-term" value="24" onchange="d.szb()"> 24 Monate</label>
              </div>
            </div>
            <div class="vor-field"><label id="szb-fee-lbl">Bearbeitungsgeb&#252;hr (USD)</label><input type="text" id="szb-fee" placeholder="—" oninput="d.szb()"><p class="note2" style="margin-top:2px">Bei 12 Monaten 1.5% des Kreditbetrags</p></div>
            <div class="vor-field"><label id="szb-btc-lbl">Aktueller Bitcoin-Preis (USD)</label><input type="number" id="szb-btc" placeholder="71549" oninput="d.szb()"></div>
            <div class="vor-field"><label>Netzwerkgeb&#252;hr (BTC)</label><input type="number" id="szb-nwfee" placeholder="0.00001" step="0.00001" oninput="d.szb()"></div>
          </div>
          <div class="tg2" style="margin-top:.75rem">
            <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
              <div style="font-size:11px;font-weight:600;color:var(--text3);margin-bottom:.4rem">Mit Bearbeitungs- und Netzwerkgeb&#252;hr</div>
              <div style="font-size:11px;color:var(--text4)">Zu hinterlegende Sicherheit (Bitcoin)</div>
              <div id="szb-mit-btc" style="font-size:14px;font-weight:700;color:var(--accent)">—</div>
              <div id="szb-mit-ccy-lbl" style="font-size:11px;color:var(--text4);margin-top:.25rem">Zu hinterlegende Sicherheit (USD)</div>
              <div id="szb-mit-usd" style="font-size:14px;font-weight:700;color:var(--text)">—</div>
            </div>
            <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
              <div style="font-size:11px;font-weight:600;color:var(--text3);margin-bottom:.4rem">Ohne Bearbeitungs- und Netzwerkgeb&#252;hr</div>
              <div style="font-size:11px;color:var(--text4)">Zu hinterlegende Sicherheit (Bitcoin)</div>
              <div id="szb-ohne-btc" style="font-size:14px;font-weight:700;color:var(--accent)">—</div>
              <div id="szb-ohne-ccy-lbl" style="font-size:11px;color:var(--text4);margin-top:.25rem">Zu hinterlegende Sicherheit (USD)</div>
              <div id="szb-ohne-usd" style="font-size:14px;font-weight:700;color:var(--text)">—</div>
            </div>
          </div>
        </div>

        <!-- 3. Maximaler Kreditbetrag mit Reserve -->
        <div class="card">
          <span class="card-title">Maximaler Kreditbetrag mit Reserve</span>
          <p class="note2" style="margin-bottom:.75rem">Ich will einer m&#246;glichen Liquidation fr&#252;hzeitig entgehen.<br>Welchen max. Kreditbetrag bekomme ich, wenn ich eine Bitcoin-Reserve behalte, um den Kredit bei einem Kursrückgang vorzeitig zur&#252;ckzuzahlen?</p>
          <div class="tg3">
            <div class="vor-field"><label id="mkr-btc-lbl">Aktueller Bitcoin-Preis (USD)</label><input type="number" id="mkr-btc" placeholder="71549" oninput="d.mkr()"></div>
            <div class="vor-field"><label>Gesamte Bitcoin in meinem Besitz</label><input type="number" id="mkr-btcanz" placeholder="1.00" step="0.001" oninput="d.mkr()"></div>
            <div class="vor-field"><label id="mkr-wert-lbl">Aktueller Wert der Bitcoin (USD)</label><input type="text" id="mkr-wert" placeholder="—" readonly style="background:var(--bg2);color:var(--text3)"></div>
          </div>
          <p style="font-size:12px;font-weight:600;color:var(--text2);margin:.75rem 0 .4rem">Angaben zum gew&#252;nschten Kredit</p>
          <div class="tg3">
            <div class="vor-field">
              <label>Kreditlaufzeit</label>
              <div style="display:flex;flex-wrap:wrap;gap:.4rem .75rem;margin-top:.35rem">
                <label style="font-weight:400;font-size:13px;display:inline-flex;align-items:center;gap:.3rem;white-space:nowrap"><input type="radio" name="mkr-term" value="3" onchange="d.mkr()"> 3 Monate</label>
                <label style="font-weight:400;font-size:13px;display:inline-flex;align-items:center;gap:.3rem;white-space:nowrap"><input type="radio" name="mkr-term" value="6" onchange="d.mkr()"> 6 Monate</label>
                <label style="font-weight:400;font-size:13px;display:inline-flex;align-items:center;gap:.3rem;white-space:nowrap"><input type="radio" name="mkr-term" value="12" checked onchange="d.mkr()"> 12 Monate</label>
                <label style="font-weight:400;font-size:13px;display:inline-flex;align-items:center;gap:.3rem;white-space:nowrap"><input type="radio" name="mkr-term" value="18" onchange="d.mkr()"> 18 Monate</label>
                <label style="font-weight:400;font-size:13px;display:inline-flex;align-items:center;gap:.3rem;white-space:nowrap"><input type="radio" name="mkr-term" value="24" onchange="d.mkr()"> 24 Monate</label>
              </div>
            </div>
            <div class="vor-field"><label>Zinssatz (%)</label><input type="number" id="mkr-rate" placeholder="10" step="0.1" oninput="d.mkr()"><br><input type="range" id="mkr-rate-sl" min="0" max="20" step="0.1" value="10" style="width:100%;margin-top:.35rem" oninput="document.getElementById('mkr-rate').value=parseFloat(this.value);document.getElementById('mkr-rate-lbl').textContent=parseFloat(this.value)+' %';d.mkr()"><span id="mkr-rate-lbl" style="font-size:11px;color:var(--text4)">10.0 %</span></div>
            <div class="vor-field"><label id="mkr-zinsen-lbl">Zinsen (USD)</label><input type="text" id="mkr-zinsen" placeholder="—" readonly style="background:var(--bg2);color:var(--text3)"></div>
          </div>
          <p style="font-size:12px;font-weight:600;color:var(--text2);margin:.75rem 0 .4rem">Angaben zum zuk&#252;nftigen Bitcoinpreis</p>
          <div class="tg3">
            <div class="vor-field">
              <label>Welche Berechnungsart?</label>
              <div style="display:flex;flex-wrap:wrap;gap:.4rem .75rem;margin-top:.35rem">
                <label style="font-weight:400;font-size:13px;display:inline-flex;align-items:center;gap:.3rem;white-space:nowrap"><input type="radio" name="mkr-calc" value="pct" checked onchange="document.getElementById('mkr-pct-row').style.display='';document.getElementById('mkr-abs-row').style.display='none';d.mkr()"> Kursrückgang in %</label>
                <label style="font-weight:400;font-size:13px;display:inline-flex;align-items:center;gap:.3rem;white-space:nowrap"><input type="radio" name="mkr-calc" value="abs" onchange="document.getElementById('mkr-pct-row').style.display='none';document.getElementById('mkr-abs-row').style.display='';d.mkr()"> Exakter Bitcoin-Preis</label>
              </div>
            </div>
            <div class="vor-field" id="mkr-pct-row">
              <label>Kursrückgang</label>
              <input type="range" id="mkr-drop-sl" min="0" max="47.5" step="0.5" value="0" style="width:100%;margin-top:.35rem" oninput="document.getElementById('mkr-drop-lbl').textContent=parseFloat(this.value).toFixed(1)+' %';d.mkr()">
              <span id="mkr-drop-lbl" style="font-size:11px;color:var(--text4)">0.0 %</span>
              <p class="note2" id="mkr-liq-warn" style="margin-top:2px;font-size:11px"></p>
            </div>
            <div class="vor-field" id="mkr-abs-row" style="display:none"><label id="mkr-future-lbl">Zuk&#252;nftiger Bitcoinpreis (USD)</label><input type="number" id="mkr-future-btc" placeholder="71549" oninput="d.mkr()"></div>
          </div>
          <p style="font-size:12px;font-weight:600;color:var(--text2);margin:.75rem 0 .4rem">Zus&#228;tzliche Angaben</p>
          <div class="tg2">
            <div class="vor-field"><label>Geb&#252;hren (BTC)</label><input type="number" id="mkr-fee" placeholder="0.00" step="0.0001" oninput="d.mkr()"><p class="note2" style="margin-top:2px">Bei 12 Monaten 1.5% des Kreditbetrags</p></div>
            <div class="vor-field"><label>Netzwerkgeb&#252;hr (BTC)</label><input type="number" id="mkr-nwfee" placeholder="0.00001" step="0.00001" oninput="d.mkr()"></div>
          </div>
          <div class="tg2" style="margin-top:.75rem">
            <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
              <div style="font-size:11px;color:var(--text4)">Kreditbetrag</div>
              <div id="mkr-result-loan" style="font-size:18px;font-weight:700;color:var(--accent)">—</div>
            </div>
            <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
              <div style="font-size:11px;color:var(--text4)">Bitcoin-Reserve</div>
              <div id="mkr-result-res" style="font-size:18px;font-weight:700;color:var(--text)">—</div>
            </div>
          </div>
          <div id="mkr-check" style="margin-top:.6rem;font-size:12px;color:var(--text3);display:none"></div>
        </div>

        <!-- 4. Bitcoin-Reserve -->
        <div class="card">
          <span class="card-title">Bitcoin-Reserve</span>
          <p class="note2" style="margin-bottom:.75rem">Ich will einer m&#246;glichen Liquidation fr&#252;hzeitig entgehen.<br>Welche Bitcoinmenge muss ich behalten, um den Kredit bei einem Kursrückgang vorzeitig zur&#252;ckzuzahlen?</p>
          <div class="tg2">
            <div class="vor-field"><label id="btr-due-lbl">F&#228;lliger Betrag (USD)</label><input type="number" id="btr-due" placeholder="11000" oninput="d.btr()"></div>
            <div class="vor-field"><label id="btr-btc-lbl">Aktueller Bitcoin-Preis (USD)</label><input type="number" id="btr-btc" placeholder="71549" oninput="d.btr()"></div>
            <div class="vor-field"><label>Zu hinterlegende Bitcoin-Sicherheit</label><input type="text" id="btr-col" placeholder="—" readonly style="background:var(--bg2);color:var(--text3)"><p class="note2" style="margin-top:2px">Ohne Bearbeitungs- und Netzwerkgeb&#252;hr</p></div>
            <div class="vor-field"><label>Liquidationspreis (USD)</label><input type="text" id="btr-liq" placeholder="—" readonly style="background:var(--bg2);color:var(--text3)"></div>
            <div class="vor-field">
              <label>Welche Berechnungsart?</label>
              <div style="display:flex;flex-wrap:wrap;gap:.4rem .75rem;margin-top:.35rem">
                <label style="font-weight:400;font-size:13px;display:inline-flex;align-items:center;gap:.3rem;white-space:nowrap"><input type="radio" name="btr-calc" value="pct" checked onchange="document.getElementById('btr-pct-row').style.display='';document.getElementById('btr-abs-row').style.display='none';d.btr()"> Kursrückgang in %</label>
                <label style="font-weight:400;font-size:13px;display:inline-flex;align-items:center;gap:.3rem;white-space:nowrap"><input type="radio" name="btr-calc" value="abs" onchange="document.getElementById('btr-pct-row').style.display='none';document.getElementById('btr-abs-row').style.display='';d.btr()"> Exakter Bitcoin-Preis</label>
              </div>
            </div>
            <div class="vor-field" id="btr-pct-row">
              <label>Kursrückgang</label>
              <input type="range" id="btr-drop-sl" min="0" max="47.5" step="0.5" value="0" style="width:100%;margin-top:.35rem" oninput="document.getElementById('btr-drop-lbl').textContent=parseFloat(this.value).toFixed(1)+' %';d.btr()">
              <span id="btr-drop-lbl" style="font-size:11px;color:var(--text4)">0.0 %</span>
              <p class="note2" id="btr-liq-warn" style="margin-top:2px;font-size:11px"></p>
            </div>
            <div class="vor-field" id="btr-abs-row" style="display:none"><label id="btr-future-lbl">Zuk&#252;nftiger Bitcoinpreis (USD)</label><input type="number" id="btr-future" placeholder="71549" oninput="d.btr()"></div>
          </div>
          <div style="margin-top:.75rem;padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
            <div style="font-size:11px;color:var(--text4)">Bitcoin als Reserve behalten</div>
            <div id="btr-result" style="font-size:18px;font-weight:700;color:var(--accent)">—</div>
          </div>
        </div>

        <!-- 5. Mit Kredit Bitcoin kaufen -->
        <div class="card">
          <span class="card-title">Mit Kredit Bitcoin kaufen</span>
          <p class="note2" style="margin-bottom:.75rem">Ich m&#246;chte mit meinem Kredit Bitcoin kaufen.<br>Welchen Preis muss Bitcoin erreichen, damit ich bei 0 bin?</p>
          <div class="tg2">
            <div class="vor-field"><label id="mkk-loan-lbl">Kreditbetrag (USD)</label><input type="number" id="mkk-loan" placeholder="10000" oninput="d.mkk()"></div>
            <div class="vor-field"><label id="mkk-zinsen-lbl">Zinsen (USD)</label><input type="number" id="mkk-zinsen" placeholder="1000" oninput="d.mkk()"></div>
            <div class="vor-field">
              <label>Kreditlaufzeit</label>
              <div style="display:flex;flex-wrap:wrap;gap:.4rem .75rem;margin-top:.35rem">
                <label style="font-weight:400;font-size:13px;display:inline-flex;align-items:center;gap:.3rem;white-space:nowrap"><input type="radio" name="mkk-term" value="3" onchange="d.mkk()"> 3 Monate</label>
                <label style="font-weight:400;font-size:13px;display:inline-flex;align-items:center;gap:.3rem;white-space:nowrap"><input type="radio" name="mkk-term" value="6" onchange="d.mkk()"> 6 Monate</label>
                <label style="font-weight:400;font-size:13px;display:inline-flex;align-items:center;gap:.3rem;white-space:nowrap"><input type="radio" name="mkk-term" value="12" checked onchange="d.mkk()"> 12 Monate</label>
                <label style="font-weight:400;font-size:13px;display:inline-flex;align-items:center;gap:.3rem;white-space:nowrap"><input type="radio" name="mkk-term" value="18" onchange="d.mkk()"> 18 Monate</label>
                <label style="font-weight:400;font-size:13px;display:inline-flex;align-items:center;gap:.3rem;white-space:nowrap"><input type="radio" name="mkk-term" value="24" onchange="d.mkk()"> 24 Monate</label>
              </div>
            </div>
            <div class="vor-field"><label id="mkk-fee-lbl">Bearbeitungsgeb&#252;hr (USD)</label><input type="text" id="mkk-fee" placeholder="—" oninput="d.mkk()"><p class="note2" style="margin-top:2px">Bei 12 Monaten 1.5% des Kreditbetrags</p></div>
            <div class="vor-field"><label>Gekaufte Bitcoin</label><input type="number" id="mkk-btcbuy" placeholder="0.10" step="0.00001" oninput="d.mkk()"></div>
            <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
              <div style="font-size:11px;color:var(--text4)">N&#246;tiger BTC Preis f&#252;r Nullsumme</div>
              <div id="mkk-result" style="font-size:18px;font-weight:700;color:var(--accent)">—</div>
            </div>
          </div>
        </div>

        <!-- 6. Loan-to-Value (gewünschter LTV → Collateral) -->
        <div class="card">
          <span class="card-title">Loan-to-Value (LTV) — Collateral berechnen</span>
          <p class="note2" style="margin-bottom:.75rem">Welche Bitcoin-Sicherheit muss ich hinterlegen, um den gew&#252;nschten LTV zu erhalten?</p>
          <div class="tg2">
            <div class="vor-field"><label id="ltvc-loan-lbl">Kreditbetrag (USD)</label><input type="number" id="ltvc-loan" placeholder="10000" oninput="d.ltvc()"></div>
            <div class="vor-field"><label id="ltvc-zinsen-lbl">Zinsen (USD)</label><input type="number" id="ltvc-zinsen" placeholder="1000" oninput="d.ltvc()"></div>
            <div class="vor-field"><label id="ltvc-btc-lbl">Aktueller Bitcoin-Preis (USD)</label><input type="number" id="ltvc-btc" placeholder="71549" oninput="d.ltvc()"></div>
            <div class="vor-field">
              <label>Gew&#252;nschter LTV</label>
              <input type="range" id="ltvc-ltv-sl" min="1" max="50" step="0.5" value="50" style="width:100%;margin-top:.35rem" oninput="document.getElementById('ltvc-ltv-lbl').textContent=parseFloat(this.value).toFixed(1)+' %';d.ltvc()">
              <span id="ltvc-ltv-lbl" style="font-size:11px;color:var(--text4)">50.0 %</span>
            </div>
            <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
              <div style="font-size:11px;color:var(--text4)">Zu hinterlegende Sicherheit (Bitcoin)</div>
              <div id="ltvc-col-btc" style="font-size:18px;font-weight:700;color:var(--accent)">—</div>
            </div>
            <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
              <div style="font-size:11px;color:var(--text4)">Zu hinterlegende Sicherheit (Dollar)</div>
              <div id="ltvc-col-usd" style="font-size:18px;font-weight:700;color:var(--text)">—</div>
            </div>
          </div>
          <div style="margin-top:.5rem;padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
            <div style="font-size:11px;color:var(--text4)">Liquidationspreis (inkl. 5% Strafe)</div>
            <div id="ltvc-liq" style="font-size:14px;font-weight:700;color:var(--text)">—</div>
          </div>
        </div>

        <!-- 7. Aktueller Liquidationspreis -->
        <div class="card">
          <span class="card-title">Aktueller Liquidationspreis</span>
          <p class="note2" style="margin-bottom:.75rem">Ich m&#246;chte jetzt einen Kredit nehmen. Wie hoch ist der aktuelle Liquidationspreis, wenn ich nur die erforderliche Bitcoin-Sicherheit hinterlege?</p>
          <div class="tg2">
            <div class="vor-field"><label id="alp-btc-lbl">Aktueller Bitcoin-Preis (USD)</label><input type="number" id="alp-btc" placeholder="71549" oninput="d.alp()"></div>
            <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border);align-self:end">
              <div style="font-size:11px;color:var(--text4)">Aktueller Liquidationspreis</div>
              <div id="alp-result" style="font-size:18px;font-weight:700;color:var(--accent)">—</div>
            </div>
          </div>
        </div>

        <!-- 8. Gesamte Zinsen -->
        <div class="card">
          <span class="card-title">Gesamte Zinsen</span>
          <p class="note2" style="margin-bottom:.75rem">Welche Zinsen muss ich f&#252;r den ganzen Kreditzeitraum bezahlen?</p>
          <div class="tg2">
            <div class="vor-field"><label id="gz-loan-lbl">Kreditbetrag (USD)</label><input type="number" id="gz-loan" placeholder="1000" oninput="d.gz()"></div>
            <div class="vor-field">
              <label>Kreditlaufzeit</label>
              <div style="display:flex;flex-wrap:wrap;gap:.4rem .75rem;margin-top:.35rem">
                <label style="font-weight:400;font-size:13px;display:inline-flex;align-items:center;gap:.3rem;white-space:nowrap"><input type="radio" name="gz-term" value="3" onchange="d.gz()"> 3 Monate</label>
                <label style="font-weight:400;font-size:13px;display:inline-flex;align-items:center;gap:.3rem;white-space:nowrap"><input type="radio" name="gz-term" value="6" onchange="d.gz()"> 6 Monate</label>
                <label style="font-weight:400;font-size:13px;display:inline-flex;align-items:center;gap:.3rem;white-space:nowrap"><input type="radio" name="gz-term" value="12" checked onchange="d.gz()"> 12 Monate</label>
                <label style="font-weight:400;font-size:13px;display:inline-flex;align-items:center;gap:.3rem;white-space:nowrap"><input type="radio" name="gz-term" value="18" onchange="d.gz()"> 18 Monate</label>
                <label style="font-weight:400;font-size:13px;display:inline-flex;align-items:center;gap:.3rem;white-space:nowrap"><input type="radio" name="gz-term" value="24" onchange="d.gz()"> 24 Monate</label>
              </div>
            </div>
            <div class="vor-field"><label>Zinssatz (%)</label><input type="number" id="gz-rate" placeholder="10" step="0.1" oninput="d.gz()"><br><input type="range" id="gz-rate-sl" min="0" max="20" step="0.1" value="10" style="width:100%;margin-top:.35rem" oninput="document.getElementById('gz-rate').value=parseFloat(this.value);document.getElementById('gz-rate-lbl').textContent=parseFloat(this.value)+' %';d.gz()"><span id="gz-rate-lbl" style="font-size:11px;color:var(--text4)">10.0 %</span></div>
          </div>
          <div class="tg2" style="margin-top:.75rem">
            <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
              <div style="font-size:11px;color:var(--text4)">Absolute Zinsen</div>
              <div id="gz-abs" style="font-size:18px;font-weight:700;color:var(--accent)">—</div>
            </div>
            <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
              <div style="font-size:11px;color:var(--text4)">Prozentuale Zinsen</div>
              <div id="gz-pct" style="font-size:18px;font-weight:700;color:var(--text)">—</div>
            </div>
          </div>
        </div>

        <!-- Bestehende Tools -->
        <div class="card">
          <span class="card-title">LTV-Rechner &amp; Margin Call Warnung</span>
          <p class="note2" style="margin-bottom:.75rem">Wie hoch ist der aktuelle LTV meines Kredits, und bei welchem Bitcoin-Preis wird ein Margin Call ausgel&#246;st?</p>
          <div class="tg2">
            <div class="vor-field">
              <label>Kreditbetrag</label>
              <div style="display:flex;gap:.4rem">
                <input type="number" id="tl" placeholder="10000" oninput="d.ltv()" style="flex:1">
                <select id="tc" onchange="d.ltv()" style="width:90px"><option>EUR</option><option>CHF</option><option>CZK</option><option>PLN</option><option>USDC</option><option>USDT</option></select>
              </div>
            </div>
            <div class="vor-field"><label>Collateral (BTC)</label><input type="number" id="tc2" placeholder="0.25" step="0.001" oninput="d.ltv()"></div>
          </div>
          <div id="ltv-r" style="display:none;margin-top:.75rem">
            <div class="tg2" style="gap:.5rem">
              <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
                <div style="font-size:11px;color:var(--text4)">Collateral-Wert (USD)</div>
                <div class="rv" id="rcol-usd" style="font-size:14px;font-weight:700;color:var(--text)">–</div>
              </div>
              <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
                <div style="font-size:11px;color:var(--text4)">Collateral-Wert (Kreditw&#228;hrung)</div>
                <div class="rv" id="rcol-ccy" style="font-size:14px;font-weight:700;color:var(--text)">–</div>
              </div>
              <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
                <div style="font-size:11px;color:var(--text4)">Aktueller LTV</div>
                <div class="rv" id="rltv" style="font-size:18px;font-weight:700;color:var(--accent)">–</div>
              </div>
              <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
                <div style="font-size:11px;color:var(--text4)">Liquidation (95%) — BTC/USD</div>
                <div class="rv err" id="rliq" style="font-size:14px;font-weight:700">–</div>
              </div>
              <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
                <div style="font-size:11px;color:var(--text4)">MC 1 (73%) — BTC/USD</div>
                <div class="rv wrn" id="rmc1" style="font-size:14px;font-weight:700">–</div>
              </div>
              <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
                <div style="font-size:11px;color:var(--text4)">MC 2 (79%) — BTC/USD</div>
                <div class="rv wrn" id="rmc2" style="font-size:14px;font-weight:700">–</div>
              </div>
              <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border);grid-column:span 2">
                <div style="font-size:11px;color:var(--text4)">MC 3 (86%) — BTC/USD</div>
                <div class="rv err" id="rmc3" style="font-size:14px;font-weight:700">–</div>
              </div>
            </div>
            <div id="ltv-w" style="margin-top:.5rem;font-size:12px;display:none"></div>
          </div>
        </div>

        <div class="card">
          <span class="card-title">Break-even-Rechner: Halten vs. Verkaufen</span>
          <p class="note2" style="margin-bottom:.75rem">Ab welchem Bitcoin-Preis lohnt sich Halten statt Verkaufen zur Schuldendeckung?</p>
          <div class="tg2">
            <div class="vor-field">
              <label>Kreditbetrag</label>
              <div style="display:flex;gap:.4rem">
                <input type="number" id="bel" placeholder="10000" oninput="d.be()" style="flex:1">
                <select id="bec" onchange="d.be()" style="width:90px"><option>EUR</option><option>CHF</option><option>CZK</option><option>PLN</option><option>USDC</option><option>USDT</option></select>
              </div>
            </div>
            <div class="vor-field"><label>Zinssatz (% p.a.)</label><input type="number" id="ber" placeholder="8" step="0.1" oninput="d.be()"></div>
            <div class="vor-field"><label>Geb&#252;hr (BTC, einmalig)</label><input type="number" id="befee" placeholder="0" step="0.0001" min="0" oninput="d.be()"></div>
            <div class="vor-field"><label>Laufzeit</label><select id="bet" onchange="d.be()"><option value="3">3 Monate</option><option value="6">6 Monate</option><option value="12" selected>12 Monate</option><option value="18">18 Monate</option></select></div>
            <div class="vor-field" style="grid-column:span 2"><label id="bebp-lbl">BTC-Preis bei Aufnahme (USD)</label><input type="number" id="bebp" placeholder="80000" oninput="d.be()"></div>
          </div>
          <div id="be-r" style="display:none;margin-top:.75rem">
            <div class="tg2" style="gap:.5rem">
              <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
                <div style="font-size:11px;color:var(--text4)">Zinskosten (Kreditw&#228;hrung)</div>
                <div class="rv" id="becost" style="font-size:14px;font-weight:700;color:var(--text)">–</div>
              </div>
              <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
                <div style="font-size:11px;color:var(--text4)">Zinskosten in USD</div>
                <div class="rv" id="becostusd" style="font-size:14px;font-weight:700;color:var(--text)">–</div>
              </div>
              <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
                <div style="font-size:11px;color:var(--text4)">BTC die du h&#228;ttest verkaufen m&#252;ssen</div>
                <div class="rv" id="bebtc" style="font-size:14px;font-weight:700;color:var(--text)">–</div>
              </div>
              <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
                <div style="font-size:11px;color:var(--text4)">Break-even BTC-Preis (USD)</div>
                <div class="rv" id="bebep" style="font-size:18px;font-weight:700;color:var(--accent)">–</div>
              </div>
            </div>
            <div id="be-v" style="margin-top:.5rem;font-size:13px;font-weight:600;display:none"></div>
          </div>
        </div>

        <div class="card">
          <span class="card-title">Schuld in allen W&#228;hrungen umrechnen</span>
          <p class="note2" style="margin-bottom:.75rem">Wie hoch ist meine Schuld umgerechnet in anderen W&#228;hrungen?</p>
          <div class="tg2">
            <div class="vor-field">
              <label>Betrag</label>
              <div style="display:flex;gap:.4rem">
                <input type="number" id="cva" placeholder="10000" oninput="d.conv()" style="flex:1">
                <select id="cvf" onchange="d.conv()" style="width:90px"><option>EUR</option><option>CHF</option><option>CZK</option><option>PLN</option><option>USDC</option><option>USDT</option><option>USD</option><option>BTC</option></select>
              </div>
            </div>
          </div>
          <div id="cv-r" style="display:none;margin-top:.75rem"><div class="ccyg" id="cv-grid"></div></div>
        </div>
      </div>

      <!-- Während Kredit -->
      <div class="tool-tab" id="tt-wae">
        <div class="card">
          <span class="card-title">Collateral-Nachschuss-Rechner</span>
          <div class="tr"><label>Kredit ausw&#228;hlen (optional)</label><select id="cn-loan-sel" onchange="d.nachFill()"><option value="">— Kredit w&#228;hlen —</option></select></div>
          <div class="tr"><label id="cn-loan-lbl">Kreditbetrag (USD)</label><input type="number" id="cnl" placeholder="10000" oninput="d.nach()"></div>
          <div class="tr"><label>Collateral (BTC)</label><input type="number" id="cncol" placeholder="0.25" step="0.001" oninput="d.nach()"></div>
          <div class="rb" id="cn-r" style="display:none">
            <div class="rr"><span class="rl">Aktueller LTV</span><span class="rv" id="cnltv">–</span></div>
            <div class="rr"><span class="rl">Nachschuss f&#252;r 50% LTV</span><span class="rv ok" id="cn50">–</span></div>
            <div class="rr"><span class="rl">Nachschuss um MC 1 (73%) zu vermeiden</span><span class="rv" id="cn75">–</span></div>
            <div class="rr"><span class="rl">Nachschuss um Liquidation zu vermeiden</span><span class="rv wrn" id="cn95">–</span></div>
          </div>
        </div>
        <div class="card">
          <span class="card-title">Neuer Liquidationspreis</span>
          <p class="note2" style="margin-bottom:.75rem">Wie hoch ist der neue Liquidationspreis, wenn ich zus&#228;tzliche Bitcoin hinterlege?</p>
          <div class="tr"><label>Kredit ausw&#228;hlen (optional)</label><select id="nlp-loan-sel" onchange="d.nlpFill()"><option value="">— Kredit w&#228;hlen —</option></select></div>
          <div class="tr"><label id="nlp-due-lbl">F&#228;lliger Betrag (Kredit + Zinsen) (USD)</label><input type="number" id="nlp-due" placeholder="11000" oninput="d.nlp()"></div>
          <div class="tr"><label>Bereits hinterlegte Bitcoin-Sicherheit</label><input type="number" id="nlp-col" placeholder="0.10" step="0.00001" oninput="d.nlp()"></div>
          <div class="tr"><label>Zus&#228;tzliche Bitcoin-Sicherheit</label><input type="number" id="nlp-add" placeholder="0.05" step="0.00001" oninput="d.nlp()"></div>
          <div class="rb" id="nlp-r" style="display:none">
            <div class="rr"><span class="rl" id="nlp-old-lbl">Bisheriger Liquidationspreis (USD)</span><span class="rv" id="nlp-old">–</span></div>
            <div class="rr"><span class="rl" id="nlp-new-lbl">Neuer Liquidationspreis (USD)</span><span class="rv ok" id="nlp-new">–</span></div>
            <div class="rr"><span class="rl">Verbesserung</span><span class="rv" id="nlp-diff">–</span></div>
          </div>
        </div>
        <div class="card">
          <span class="card-title">Sicherheit erh&#246;hen</span>
          <p class="note2" style="margin-bottom:.75rem">Wie viel Bitcoin muss ich zus&#228;tzlich hinterlegen, um den gew&#252;nschten Liquidationspreis zu erhalten?</p>
          <div class="tr"><label>Kredit ausw&#228;hlen (optional)</label><select id="se2-loan-sel" onchange="d.se2Fill()"><option value="">— Kredit w&#228;hlen —</option></select></div>
          <div class="tr"><label id="se2-due-lbl">F&#228;lliger Betrag (Kredit + Zinsen) (USD)</label><input type="number" id="se2-due" placeholder="11000" oninput="d.se2()"></div>
          <div class="tr"><label>Bereits hinterlegte Bitcoin-Sicherheit</label><input type="number" id="se2-col" placeholder="0.10" step="0.00001" oninput="d.se2()"></div>
          <div class="tr"><label id="se2-target-lbl">Ziel-Liquidationspreis (USD)</label><input type="number" id="se2-target" placeholder="30000" oninput="d.se2()"></div>
          <div class="rb" id="se2-r" style="display:none">
            <div class="rr"><span class="rl" id="se2-old-lbl">Bisheriger Liquidationspreis (USD)</span><span class="rv" id="se2-old">–</span></div>
            <div class="rr"><span class="rl">Zus&#228;tzlich ben&#246;tigte Bitcoin-Sicherheit</span><span class="rv ok" id="se2-add">–</span></div>
          </div>
        </div>

        <div class="card">
          <span class="card-title">Verl&#228;ngerungsszenarien — Kosten einer Laufzeitverlängerung</span>
          <div class="tr"><label>Kredit ausw&#228;hlen</label>
            <select id="ext-loan" onchange="d.ext()">
              <option value="">— Kredit w&#228;hlen —</option>
            </select>
          </div>
          <div class="tr"><label>Aktueller Betrag (USD)</label><span id="ext-info" style="font-size:12px;color:var(--text3)">—</span></div>
          <div class="tr"><label>F&#228;lliger Betrag</label><span id="ext-due" style="font-size:12px;color:var(--text3)">—</span></div>
          <div class="tr"><label>Startdatum (Enddatum aktueller Kredit)</label><span id="ext-start" style="font-size:12px;color:var(--text3)">—</span></div>
          <div style="margin-top:.75rem;padding:.75rem 1rem;background:var(--bg2);border-radius:10px;border:1px solid var(--border)">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:.5rem">
              <label style="font-size:12px;font-weight:600;color:var(--text2)">Zinssatz Verl&#228;ngerung</label>
              <span style="font-size:18px;font-weight:700;color:var(--accent)" id="ext-rate-val">6%</span>
            </div>
            <input type="range" id="ext-rate" min="0" max="20" step="0.1" value="6" oninput="document.getElementById('ext-rate-val').textContent=parseFloat(this.value)+'%';d.ext()">
            <div style="display:flex;justify-content:space-between;font-size:10px;color:var(--text4);margin-top:.35rem">
              <span>0%</span><span>5%</span><span>10%</span><span>15%</span><span>20%</span>
            </div>
          </div>
          <div id="ext-r" style="display:none;margin-top:.75rem">
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:.5rem" id="ext-grid"></div>
          </div>
        </div>
      </div>

      <!-- Nach Kredit -->
      <div class="tool-tab" id="tt-nach">
        <div class="card">
          <span class="card-title">Gewinn/Verlust-Rechner: Beleihen vs. Verkaufen</span>
          <p class="note2" style="margin-bottom:.75rem">Hat sich das Beleihen meiner Bitcoin gelohnt im Vergleich zu einem Verkauf?</p>
          <div class="tr"><label>Kredit ausw&#228;hlen (optional)</label><select id="gvl-loan-sel" onchange="d.gvlFill()"><option value="">— Kredit w&#228;hlen —</option></select></div>
          <div class="tg2" style="margin-top:.25rem">
            <div class="vor-field"><label id="gvl-loan-lbl">Kreditbetrag (USD)</label><input type="number" id="gvl-loan" placeholder="10000" oninput="d.gvl()"></div>
            <div class="vor-field"><label>Kreditlaufzeit</label><select id="gvl-term" onchange="d.gvl()"><option value="3">3 Monate</option><option value="6">6 Monate</option><option value="12" selected>12 Monate</option><option value="18">18 Monate</option><option value="24">24 Monate</option></select></div>
            <div class="vor-field"><label>Zinssatz (% p.a.)</label><input type="number" id="gvl-rate" placeholder="10" step="0.1" oninput="d.gvl()"></div>
            <div class="vor-field"><label id="gvl-fee-lbl">Bearbeitungsgeb&#252;hr (USD, auto) <span id="gvl-fee-reset" onclick="d.gvlFeeReset()" style="display:none;font-size:11px;font-weight:400;color:var(--accent);cursor:pointer;margin-left:.4rem">↺ Auto</span></label><input type="number" id="gvl-fee" placeholder="0" step="0.01" oninput="d.gvlFeeManual()"></div>
            <div class="vor-field"><label id="gvl-btcstart-lbl">Bitcoin-Preis bei Kreditnahme (USD) <span id="gvl-start-date" style="font-weight:400;color:var(--text4)"></span></label><input type="number" id="gvl-btcstart" placeholder="80000" oninput="d.gvl()"><span id="gvl-api-hint" style="display:none;font-size:11px;color:#d97706;margin-top:.25rem"></span></div>
            <div class="vor-field"><label id="gvl-btcnow-lbl">Aktueller Bitcoin-Preis (USD)</label><input type="number" id="gvl-btcnow" placeholder="85000" oninput="d.gvl()"></div>
          </div>
          <div class="rb" id="gvl-r" style="display:none;margin-top:.75rem">
            <div class="rr"><span class="rl">BTC die man h&#228;tte verkaufen m&#252;ssen</span><span class="rv" id="gvl-btcamt">–</span></div>
            <div class="rr"><span class="rl">Wert dieser BTC heute</span><span class="rv" id="gvl-btcval">–</span></div>
            <div class="rr"><span class="rl" id="gvl-zinsen-lbl">Zinsen (USD)</span><span class="rv" id="gvl-zinsen">–</span></div>
            <div class="rr"><span class="rl" id="gvl-gebühr-lbl">Bearbeitungsgeb&#252;hr (USD)</span><span class="rv" id="gvl-gebuehr">–</span></div>
            <div class="rr" style="border-top:1px solid var(--border);padding-top:.5rem;margin-top:.25rem"><span class="rl" style="font-weight:700">Gewinn/Verlust durch Beleihen</span><span class="rv" id="gvl-result" style="font-weight:700">–</span></div>
          </div>
        </div>
      </div>

      <!-- Powerlaw -->
      <div class="tool-tab" id="tt-pow">

        <!-- 1. Power Law Fair Price -->
        <div class="card">
          <span class="card-title">Power Law Fair Price</span>
          <p class="note2" style="margin-bottom:.75rem">Ich m&#246;chte nur einen Kredit nehmen, wenn Bitcoin laut dem Power Law unterbewertet ist.</p>
          <div class="tg3" style="margin-bottom:.75rem">
            <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
              <div style="font-size:11px;color:var(--text4)">Aktueller BTC-Preis (USD)</div>
              <div id="pl1-btc" style="font-size:15px;font-weight:700;color:var(--text)">—</div>
            </div>
            <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
              <div style="font-size:11px;color:var(--text4)">Power Law Fair Price (USD)</div>
              <div id="pl1-fair" style="font-size:15px;font-weight:700;color:var(--accent)">—</div>
            </div>
            <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
              <div style="font-size:11px;color:var(--text4)">Abweichung</div>
              <div id="pl1-dev" style="font-size:15px;font-weight:700">—</div>
            </div>
          </div>
          <div id="pl1-verdict" style="padding:.65rem .85rem;border-radius:8px;font-size:13px;font-weight:600;display:none"></div>
        </div>

        <!-- 2. Power Law Bottom Price -->
        <div class="card">
          <span class="card-title">Power Law Bottom Price</span>
          <p class="note2" style="margin-bottom:.75rem">Ich m&#246;chte nur einen Kredit nehmen, wenn der Liquidationspreis des Kredits der Preisuntergrenze des Power Laws entspricht oder sich darunter befindet.</p>
          <div class="tg3" style="margin-bottom:.75rem">
            <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
              <div style="font-size:11px;color:var(--text4)">Aktueller Bitcoin-Preis (USD)</div>
              <div id="pl2-btc" style="font-size:15px;font-weight:700;color:var(--text)">—</div>
            </div>
            <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
              <div style="font-size:11px;color:var(--text4)">Untergrenze des Power Laws (USD)</div>
              <div id="pl2-bottom" style="font-size:15px;font-weight:700;color:var(--accent)">—</div>
            </div>
            <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
              <div style="font-size:11px;color:var(--text4)">N&#246;tiger Bitcoin-Preis (USD)</div>
              <div id="pl2-needed" style="font-size:15px;font-weight:700;color:var(--text)">—</div>
            </div>
          </div>
          <div class="tg2" style="margin-bottom:.75rem">
            <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
              <div style="font-size:11px;color:var(--text4)">Preis des Power Laws (USD)</div>
              <div id="pl2-fair" style="font-size:15px;font-weight:700;color:var(--text)">—</div>
            </div>
            <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
              <div style="font-size:11px;color:var(--text4)">Abweichung</div>
              <div id="pl2-dev" style="font-size:15px;font-weight:700">—</div>
            </div>
          </div>
          <div id="pl2-verdict" style="padding:.65rem .85rem;border-radius:8px;font-size:13px;font-weight:600"></div>
        </div>

        <!-- 3. Power Law Overvalued -->
        <div class="card">
          <span class="card-title">Power Law Overvalued</span>
          <p class="note2" style="margin-bottom:.75rem">Ich m&#246;chte meinen Kredit nur vorzeitig zur&#252;ckzahlen, wenn Bitcoin laut dem Power Law &#252;berbewertet ist.</p>
          <div class="tg2" style="margin-bottom:.75rem">
            <div class="vor-field">
              <label>&#220;berbewertungs-Schwelle</label>
              <input type="range" id="pl3-thresh-sl" min="0" max="200" step="1" value="0" style="width:100%;margin-top:.35rem" oninput="document.getElementById('pl3-thresh').value=parseInt(this.value);document.getElementById('pl3-thresh-lbl').textContent=parseInt(this.value)+' %';d.pl3()">
              <span id="pl3-thresh-lbl" style="font-size:11px;color:var(--text4)">0 %</span>
            </div>
            <div class="vor-field"><label>Oder manuell eingeben (%)</label><input type="number" id="pl3-thresh" placeholder="0" min="0" oninput="var v=parseInt(this.value)||0;document.getElementById('pl3-thresh-sl').value=Math.min(v,200);document.getElementById('pl3-thresh-lbl').textContent=v+' %';d.pl3()"></div>
          </div>
          <div class="tg3" style="margin-bottom:.75rem">
            <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
              <div style="font-size:11px;color:var(--text4)">Aktueller BTC-Preis (USD)</div>
              <div id="pl3-btc" style="font-size:15px;font-weight:700;color:var(--text)">—</div>
            </div>
            <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
              <div style="font-size:11px;color:var(--text4)">Fair Price + Schwelle (USD)</div>
              <div id="pl3-target" style="font-size:15px;font-weight:700;color:var(--accent)">—</div>
            </div>
            <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
              <div style="font-size:11px;color:var(--text4)">Abweichung</div>
              <div id="pl3-dev" style="font-size:15px;font-weight:700">—</div>
            </div>
          </div>
          <div id="pl3-verdict" style="padding:.65rem .85rem;border-radius:8px;font-size:13px;font-weight:600;display:none"></div>
        </div>

        <!-- 4. Power Law Liquidationspreis -->
        <div class="card">
          <span class="card-title">Power Law Liquidationspreis</span>
          <p class="note2" style="margin-bottom:.75rem">Wie viel Bitcoin muss ich als Sicherheit hinterlegen, damit der Liquidationspreis meines Kredits dem Bottom Price des Power Laws entspricht?</p>
          <div class="tg2" style="margin-bottom:.75rem">
            <div class="vor-field"><label id="pl4-due-lbl">F&#228;lliger Betrag (Kredit + Zinsen) (USD)</label><input type="number" id="pl4-due" placeholder="11000" oninput="d.pl4()"></div>
          </div>
          <div class="tg3" style="margin-bottom:.75rem">
            <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
              <div style="font-size:11px;color:var(--text4)">Power Law Bottom Price (USD)</div>
              <div id="pl4-bottom" style="font-size:15px;font-weight:700;color:var(--accent)">—</div>
            </div>
            <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
              <div style="font-size:11px;color:var(--text4)">Aktueller BTC-Preis (USD)</div>
              <div id="pl4-btc" style="font-size:15px;font-weight:700;color:var(--text)">—</div>
            </div>
            <div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">
              <div style="font-size:11px;color:var(--text4)">Initialer LTV</div>
              <div id="pl4-ltv" style="font-size:15px;font-weight:700;color:var(--text)">—</div>
            </div>
          </div>
          <div style="padding:.75rem .85rem;background:var(--accent-bg);border-radius:8px;border:1px solid #fed7aa">
            <div style="font-size:11px;color:var(--text4);margin-bottom:.3rem">Ben&#246;tigte Bitcoin-Sicherheit (damit Liq.-Preis = Bottom Price)</div>
            <div id="pl4-col" style="font-size:22px;font-weight:700;color:var(--accent)">—</div>
            <div id="pl4-formula" style="font-size:11px;color:var(--text4);margin-top:.3rem"></div>
          </div>
        </div>

      </div>

      <!-- Roll-Over Simulation -->
      <div class="tool-tab" id="tt-rosi">
        <div class="card" style="grid-column:1/-1">
          <span class="card-title">Roll-Over Simulation</span>
          <p class="note2" style="margin-bottom:.75rem">Simuliere mehrere aufeinanderfolgende Roll-Overs und sieh, was dich das Darlehen über die gesamte Laufzeit kostet.</p>
          <div class="tr" style="margin-bottom:.75rem"><label>Kredit auswählen (optional)</label><select id="rosi-loan-sel" onchange="d.rosiFill()"><option value="">— Kredit wählen —</option></select></div>
          <div class="tg3" style="margin-bottom:.75rem">
            <div class="vor-field"><label>Kreditbetrag</label><input type="number" id="rosi-amount" placeholder="10000" oninput="d.rosi()"></div>
            <div class="vor-field"><label>Währung</label>
              <select id="rosi-ccy" onchange="d.rosiCcyChange();d.rosi()">
                <option>EUR</option><option>CHF</option><option selected>USD</option><option>USDC</option><option>USDT</option>
              </select>
            </div>
            <div class="vor-field"><label>Laufzeit pro Roll-Over</label>
              <select id="rosi-term" onchange="d.rosi()">
                <option value="3">3 Monate</option><option value="6">6 Monate</option>
                <option value="12" selected>12 Monate</option><option value="18">18 Monate</option><option value="24">24 Monate</option>
              </select>
            </div>
            <div class="vor-field"><label>Zinssatz 1. Kredit (% p.a.)</label><input type="number" id="rosi-rate1" placeholder="10" step="0.1" oninput="d.rosi()"></div>
            <div class="vor-field"><label>Zinssatz Folge-Roll-Overs (% p.a.)</label><input type="number" id="rosi-rate2" placeholder="10" step="0.1" oninput="d.rosi()"></div>
            <div class="vor-field"><label>Gebühr pro Roll-Over</label>
              <div id="rosi-fee-display" style="padding:.4rem .6rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border);font-size:13px;color:var(--text3)">— (wird berechnet)</div>
              <span style="font-size:11px;color:var(--text4);margin-top:3px;display:block">1.5% p.a. × Laufzeit × Kreditbetrag</span>
            </div>
            <div class="vor-field"><label>Anzahl Roll-Overs: <span id="rosi-n-lbl" style="color:var(--accent);font-weight:700">3</span></label>
              <input type="range" id="rosi-n-sl" min="1" max="20" step="1" value="3" style="width:100%;margin-top:.35rem" oninput="document.getElementById('rosi-n').value=this.value;document.getElementById('rosi-n-lbl').textContent=this.value;d.rosi()">
              <input type="number" id="rosi-n" value="3" min="1" max="20" style="width:60px;margin-top:.3rem" oninput="var v=Math.max(1,Math.min(20,parseInt(this.value)||1));this.value=v;document.getElementById('rosi-n-sl').value=v;document.getElementById('rosi-n-lbl').textContent=v;d.rosi()">
            </div>
            <div class="vor-field"><label id="rosi-btc-lbl">BTC-Preis (USD)</label><input type="number" id="rosi-btc" placeholder="85000" oninput="d.rosi()"></div>
            <div class="vor-field"><label>Startdatum</label><input type="date" id="rosi-start" oninput="d.rosi()"></div>
          </div>
          <div id="rosi-r" style="display:none">
            <div class="tg3" style="margin-bottom:.75rem" id="rosi-summary"></div>
            <div class="ovx"><table class="loans-table" id="rosi-tbl"></table></div>
          </div>
        </div>
      </div>

      <!-- Zukunftssimulation -->
      <div class="tool-tab" id="tt-zukunft">
        <div class="card" style="grid-column:1/-1">
          <span class="card-title">Zukunftssimulation</span>
          <p class="note2" style="margin-bottom:.75rem">Wie entwickeln sich Schulden und Collateral-Wert meiner aktiven Kredite bei einem bestimmten BTC-Preis und Datum?</p>

          <div class="tg3" style="margin-bottom:.75rem">
            <div class="vor-field">
              <label>Zukünftiger BTC-Preis (USD)</label>
              <input type="number" id="zk-btc" placeholder="z.B. 150000" oninput="d.zukunft()">
            </div>
            <div class="vor-field">
              <label>Zieldatum <span style="font-weight:400;color:var(--text4)">(optional)</span></label>
              <input type="date" id="zk-date" onchange="d.zukunft()">
            </div>
            <div class="vor-field">
              <label>Zinssatz Verlängerung (% p.a.) <span style="font-weight:400;color:var(--text4)">(optional)</span></label>
              <input type="number" id="zk-rate" placeholder="Wie Kredit" step="0.1" oninput="d.zukunft()">
              <span style="font-size:11px;color:var(--text4);margin-top:3px;display:block">Für bereits fällige Kredite zum Zieldatum</span>
            </div>
          </div>

          <div id="zk-r" style="display:none">
            <div class="tg3" style="margin-bottom:1rem" id="zk-summary"></div>
            <div class="ch-wrap" style="height:280px;margin-bottom:1rem"><canvas id="zk-chart"></canvas></div>
            <div class="ovx"><table class="loans-table" id="zk-tbl"></table></div>
          </div>
          <div id="zk-empty" style="display:none;padding:1rem;color:var(--text4);font-size:13px;text-align:center">Keine aktiven Kredite vorhanden.</div>
        </div>
      </div>

    </div>

    <!-- ── STRESS TEST ── -->
    <div class="sec" id="s-st">
      <div class="card" style="margin-bottom:1rem">
        <span class="card-title">Stress-Test — BTC-Kursszenarien</span>
        <p class="note2 mb">LTV aller aktiven Kredite bei verschiedenen BTC-Kursrückgängen.</p>
        <div class="fx mb">
          <span class="note2">Aktueller BTC-Preis:</span>
          <b id="st-btc" style="font-size:13px;color:var(--text)">–</b>
          <button class="sm" onclick="d.stress()">Aktualisieren</button>
        </div>
        <div id="st-r"></div>
      </div>
      <div class="card" style="margin-bottom:1rem">
        <span class="card-title">BTC-Preis-Heatmap — Liquidationsrisiko pro Kredit</span>
        <p class="note2" style="margin-bottom:.75rem">Zeigt bei welchem BTC-Preis jeder aktive Kredit die MC1 (73%), MC3 (86%) und Liquidations-Schwelle (95%) erreicht.</p>
        <div id="ch-heat" style="overflow-x:auto"></div>
      </div>
      <div class="card">
        <span class="card-title">Worst-Case-Simulator — Was passiert bei einem BTC-Einbruch?</span>
        <p class="note2" style="margin-bottom:.75rem">Stelle einen beliebigen BTC-Preis ein und sieh welche Kredite liquidiert werden.</p>
        <div class="tr">
          <label>BTC-Preis simulieren (USD)</label>
          <input type="number" id="wc-btc" placeholder="z.B. 50000" oninput="d.wc()">
          <span style="font-size:11px;color:var(--text3)" id="wc-pct"></span>
        </div>
        <div id="wc-r" style="margin-top:.75rem"></div>
      </div>
    </div>

    <!-- ── CALENDAR ── -->
    <div class="sec" id="s-ca">
      <div class="card">
        <div class="cal-nav">
          <button class="sm" onclick="d.calPrev()">&#8249;</button>
          <span class="cal-title" id="cal-title"></span>
          <button class="sm" onclick="d.calNext()">&#8250;</button>
        </div>
        <div class="cg" id="cal-grid"></div>
        <div class="fx" style="margin-top:.75rem;font-size:11px;color:var(--text3);gap:12px">
          <span><span style="display:inline-block;width:10px;height:10px;background:#F97316;border-radius:2px;margin-right:3px;vertical-align:middle"></span>F&#228;lligkeit</span>
          <span><span style="display:inline-block;width:10px;height:10px;background:#dc2626;border-radius:2px;margin-right:3px;vertical-align:middle"></span>&#8804;14 Tage</span>
        </div>
      </div>
      <span class="sh mt">Bevorstehende F&#228;lligkeiten</span>
      <div id="upcoming"></div>
    </div>

    <!-- ── TIMELINE ── -->
    <div class="sec" id="s-tl">
      <span class="sh">Kreditlaufzeiten</span>
      <div id="tl-list"></div>
      <div class="mt">
        <span class="sh">Schulden-Verlauf</span>
        <div class="card">
          <div class="csw" id="debt-csw"></div>
          <div class="ch-wrap"><canvas id="debt-chart"></canvas></div>
          <div class="stats" id="debt-stats"></div>
        </div>
        <div class="mt">
          <span class="sh">Zinskosten pro Kredit (aktiv, in USD)</span>
          <div class="card"><div class="ch-wrap"><canvas id="int-chart"></canvas></div></div>
        </div>
      </div>
    </div>

    <!-- EDIT MODAL -->
    <div class="modal-bg" id="edit-modal-bg" onclick="if(event.target===this)d.closeEdit()">
      <div class="modal">
        <div class="modal-title">
          <span>Kredit bearbeiten</span>
          <button class="modal-close" onclick="d.closeEdit()">&#10005;</button>
        </div>
        <div class="fg">
          <div class="ff"><label>Bezeichnung</label><input type="text" id="ef-n" placeholder="Kredit #X"></div>
          <div class="ff"><label>ID</label><input type="text" id="ef-id" placeholder="z.B. abc12345" style="font-family:monospace"></div>
          <div class="ff"><label>Betrag</label><input type="number" id="ef-a" placeholder="10000"></div>
          <div class="ff"><label>Zinssatz (% p.a.)</label><input type="number" id="ef-r" placeholder="8" step="0.1"></div>
          <div class="ff"><label>Gebühr (BTC, einmalig)</label><input type="number" id="ef-fee" placeholder="0" step="0.0001" min="0"></div>
          <div class="ff"><label>Laufzeit (Monate)</label>
            <select id="ef-t"><option>3</option><option>6</option><option>12</option><option>18</option><option>24</option></select></div>
          <div class="ff"><label>Startdatum</label><input type="date" id="ef-d" onchange="d.autoFillBtcStart('ef-d','ef-bp','ef-bp-hint')"></div>
          <div class="ff"><label>Collateral (BTC)</label><input type="number" id="ef-b" placeholder="0.25" step="0.001"></div>
          <div class="ff"><label>Status</label>
            <select id="ef-s"><option value="active">Aktiv</option><option value="closed">Abgeschlossen</option></select></div>
          <div class="ff"><label>W&#228;hrung</label>
            <select id="ef-c"><option>EUR</option><option>CHF</option><option>CZK</option><option>PLN</option><option>USDC</option><option>USDT</option></select></div>
          <div class="ff" style="grid-column:span 2"><label>BTC-Preis bei Kreditaufnahme (USD) &#8212; f&#252;r Break-even</label><input type="number" id="ef-bp" placeholder="z.B. 85000" step="1"><span id="ef-bp-hint" style="display:none;font-size:11px;color:var(--text4);margin-top:3px"></span></div>
          <div class="ff" style="grid-column:span 2"><label>Roll-Over-Kette</label><select id="ef-chain"><option value="">— Keine Kette —</option></select><span style="font-size:11px;color:var(--text4);margin-top:3px;display:block">Vorläufer-Kredit wählen oder neue Kette starten</span></div>
          <div class="ff" style="grid-column:span 2"><label>Notiz</label><textarea id="ef-note" rows="2" placeholder="Konditionen, Kontaktperson, Besonderheiten…" style="width:100%;padding:6px 8px;border:1px solid var(--border);border-radius:8px;background:var(--bg);color:var(--text);font-size:13px;resize:vertical;font-family:inherit"></textarea></div>
        </div>
        <div class="modal-actions">
          <button class="sm" onclick="d.closeEdit()">Abbrechen</button>
          <button class="primary sm" onclick="d.saveEdit()">&#10003; Speichern</button>
        </div>
      </div>
    </div>

    <!-- ── CHARTS ── -->
    <div class="sec" id="s-ch">
      <span class="sh">Diagramme</span>

      <!-- Row 1: LTV-Verlauf + Margin-Call-Distanz -->
      <div class="tg2" style="gap:1rem;margin-bottom:1rem">
        <div class="card">
          <span class="card-title">LTV pro Kredit — aktuell &amp; historischer Verlauf</span>
          <div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:.5rem" id="ch-ltv-sel"></div>
          <div class="ch-wrap" style="height:240px"><canvas id="ch-ltv"></canvas></div>
        </div>
        <div class="card">
          <span class="card-title">Margin-Call-Distanz (% BTC-Preisfall bis MC1 73%)</span>
          <div class="ch-wrap" style="height:220px"><canvas id="ch-mcd"></canvas></div>
        </div>
      </div>

      <!-- Row 2: Collateral-Konzentration + Währungsverteilung -->
      <div class="tg2" style="gap:1rem;margin-bottom:1rem">
        <div class="card">
          <span class="card-title">Collateral-Konzentration (BTC pro Kredit)</span>
          <div style="display:flex;justify-content:center"><div class="ch-wrap" style="height:300px;width:100%"><canvas id="ch-col"></canvas></div></div>
        </div>
        <div class="card">
          <span class="card-title">Währungsverteilung (Kreditsummen)</span>
          <div style="display:flex;justify-content:center"><div class="ch-wrap" style="height:300px;width:100%"><canvas id="ch-ccy"></canvas></div></div>
        </div>
      </div>

      <!-- Row 3: Break-even-Übersicht -->
      <div class="card" style="margin-bottom:1rem">
        <span class="card-title">Break-even-Übersicht — BTC-Preis bei Aufnahme vs. Break-even vs. aktuell</span>
        <div class="ch-wrap" style="height:240px"><canvas id="ch-bep"></canvas></div>
        <p class="note2" style="margin-top:.4rem;font-size:11px">* Kein BTC-Startpreis hinterlegt — historischer Preis vom Kreditdatum wird via Coingecko geladen.</p>
      </div>

      <!-- Row 4: Zinskosten-Vergleich + Effektivkosten in BTC -->
      <div class="tg2" style="gap:1rem;margin-bottom:1rem">
        <div class="card">
          <span class="card-title">Zinskosten gesamt vs. bisher aufgelaufen (USD)</span>
          <div class="ch-wrap" style="height:220px"><canvas id="ch-int"></canvas></div>
        </div>
        <div class="card">
          <span class="card-title">Effektivkosten in BTC (Zinsen / BTC-Startpreis)</span>
          <div class="ch-wrap" style="height:220px"><canvas id="ch-btcost"></canvas></div>
        </div>
      </div>

      <!-- Row 4b: Zinslast über Zeit -->
      <div class="card" style="margin-bottom:1rem">
        <span class="card-title">Monatliche Zinslast — Verlauf über Zeit (USD)</span>
        <p class="note2" style="margin-bottom:.75rem">Monatliche Zinszahlungen aller aktiven Kredite, gestapelt nach Kredit. Zeigt wann Zinslast aus- oder hinzukommt.</p>
        <div class="ch-wrap" style="height:260px"><canvas id="ch-zinslast"></canvas></div>
      </div>

      <!-- Roll-Over Timeline -->
      <div class="card" style="margin-bottom:1rem">
        <span class="card-title">Roll-Over-Timeline — Kettenverläufe</span>
        <p class="note2" style="margin-bottom:.75rem">Aufeinanderfolgende Roll-Overs einer Kette als verbundene Balken. Zinskosten pro Segment annotiert.</p>
        <div id="ch-ro-timeline" style="overflow-x:auto"></div>
      </div>

      <!-- Row 5: Fälligkeits-Timeline (Gantt) -->
      <div class="card" style="margin-bottom:1rem">
        <span class="card-title">Fälligkeits-Timeline</span>
        <div id="ch-gantt" style="overflow-x:auto"></div>
      </div>

      <!-- Row 6: Cashflow-Vorschau + Schulden vs. Collateral -->
      <div class="tg2" style="gap:1rem;margin-bottom:1rem">
        <div class="card">
          <span class="card-title">Fällige Gesamtbeträge nächste 12 Monate — Kapital + Zinsen (USD)</span>
          <div class="ch-wrap" style="height:220px"><canvas id="ch-cf"></canvas></div>
        </div>
        <div class="card">
          <span class="card-title">Schulden vs. Collateral-Wert (USD, 12 Monate)</span>
          <div class="ch-wrap" style="height:220px"><canvas id="ch-dcol"></canvas></div>
        </div>
      </div>

      <!-- Row 7: Laufzeitverteilung -->
      <div class="card">
        <span class="card-title">Laufzeitverteilung — Fälligkeiten nach Zeitraum</span>
        <p class="note2" style="margin-bottom:.75rem">Gruppiert aktive Kredite nach verbleibender Laufzeit.</p>
        <div class="ch-wrap" style="height:260px"><canvas id="ch-term"></canvas></div>
      </div>
    </div>

    <!-- ── SETTINGS ── -->
    <!-- ── STATISTICS ── -->
    <div class="sec" id="s-ro">
      <div id="ro-content"></div>
    </div>

    <div class="sec" id="s-sx">
      <div id="sx-content"></div>
    </div>

    <div class="sec" id="s-se">
      <span class="sh">Einstellungen</span>
      <div class="card" style="margin-bottom:1rem">
        <span class="card-title">Bevorzugte W&#228;hrungen</span>
        <p class="note2" style="margin-bottom:.75rem">Nur ausgew&#228;hlte W&#228;hrungen werden in Kreditkarten, Charts und Umrechnungen angezeigt.</p>
        <div style="display:flex;flex-wrap:wrap;gap:8px" id="ccy-toggles"></div>
        <div style="margin-top:1rem;display:flex;gap:8px">
          <button class="sm" onclick="d.ccyAll()">Alle ausw&#228;hlen</button>
          <button class="sm primary" onclick="d.ccySave()">&#10003; Speichern</button>
        </div>
        <div id="ccy-saved-msg" style="display:none;margin-top:.5rem;font-size:12px;color:var(--ok)">&#10003; Gespeichert.</div>
      </div>

      <div class="card" style="margin-bottom:1rem">
        <span class="card-title">Darstellung &amp; Navigation</span>
        <div class="fg" style="margin-top:.75rem">
          <div class="ff">
            <label>Standardansicht beim Laden</label>
            <select id="se-default-tab">
              <option value="ov">&#220;bersicht</option>
              <option value="lo">Meine Kredite</option>
              <option value="ch">Diagramme</option>
              <option value="sx">Statistiken</option>
              <option value="ca">Kalender</option>
              <option value="tl">Timeline</option>
              <option value="ro">Roll-Overs</option>
              <option value="st">Stress-Test</option>
              <option value="to">Tools</option>
            </select>
          </div>
          <div class="ff">
            <label>Standardm&#228;ssige Kreditansicht</label>
            <select id="se-default-view">
              <option value="grid">Kacheln</option>
              <option value="list">Liste</option>
            </select>
          </div>
          <div class="ff">
            <label>Standardw&#228;hrung f&#252;r neue Kredite</label>
            <select id="se-default-ccy">
              <option>EUR</option><option>CHF</option><option>CZK</option><option>PLN</option><option>USDC</option><option>USDT</option>
            </select>
          </div>
          <div class="ff">
            <label>Farbmodus</label>
            <select id="se-color-mode">
              <option value="light">Hell</option>
              <option value="dark">Dunkel</option>
            </select>
          </div>
        </div>
        <div style="margin-top:1rem">
          <label style="font-size:12px;font-weight:600;color:var(--text2)">Men&#252;reihenfolge</label>
          <p class="note2" style="margin:.25rem 0 .5rem">Per Drag &amp; Drop oder Pfeile verschieben.</p>
          <div id="se-nav-order" style="display:flex;flex-direction:column;gap:4px"></div>
          <div style="margin-top:.5rem;display:inline-flex;gap:8px;align-items:center">
            <button class="sm" onclick="d.seNavOrderReset()">Zur&#252;cksetzen</button>
            <span id="se-nav-msg" style="display:none;font-size:12px;color:var(--ok)">&#10003; Gespeichert.</span>
          </div>
        </div>
        <div style="margin-top:.75rem">
          <button class="sm primary" onclick="d.seDisplaySave()">&#10003; Speichern</button>
          <span id="se-display-msg" style="display:none;margin-left:.75rem;font-size:12px;color:var(--ok)">&#10003; Gespeichert.</span>
        </div>
      </div>

      <div class="card" style="margin-bottom:1rem">
        <span class="card-title">Kreditkarten</span>
        <div style="margin-top:.75rem;display:flex;flex-direction:column;gap:10px">
          <label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;color:var(--text)">
            <input type="checkbox" id="se-hide-breakeven" style="accent-color:var(--accent);width:15px;height:15px">
            Break-Even Meldung ausblenden
          </label>
        </div>
        <div style="margin-top:.75rem">
          <button class="sm primary" onclick="d.seCardSave()">&#10003; Speichern</button>
          <span id="se-card-msg" style="display:none;margin-left:.75rem;font-size:12px;color:var(--ok)">&#10003; Gespeichert.</span>
        </div>
      </div>

      <div class="card" style="margin-bottom:1rem">
        <span class="card-title">LTV-Schwellenwerte</span>
        <p class="note2" style="margin-bottom:.75rem">Basierend auf den Firefish Margin Call Schwellen. Steuert Alarmfarben, Warnbanner und die LTV-Filterliste.</p>
        <div class="fg" style="margin-top:.75rem">
          <div class="ff">
            <label style="color:var(--warn)">&#9888; MC1 — Warnschwelle (%)</label>
            <input type="number" id="se-ltv-warn" min="1" max="99" step="1" placeholder="73">
          </div>
          <div class="ff">
            <label style="color:var(--warn)">&#9888; MC2 — Kritische Schwelle (%)</label>
            <input type="number" id="se-ltv-crit" min="1" max="99" step="1" placeholder="79">
          </div>
          <div class="ff">
            <label style="color:var(--err)">&#128308; MC3 — Gefahrenschwelle (%)</label>
            <input type="number" id="se-ltv-danger" min="1" max="99" step="1" placeholder="86">
          </div>
          <div class="ff">
            <label>&#128200; Anzeige-Schwelle &#220;bersicht (%)</label>
            <input type="number" id="se-ltv-display" min="1" max="100" step="1" placeholder="73">
          </div>
        </div>
        <p class="note2" style="margin-top:.5rem">Liquidation (95%) ist ein fester Firefish-Wert und nicht konfigurierbar.</p>
        <div style="margin-top:.75rem">
          <button class="sm primary" onclick="d.seLtvSave()">&#10003; Speichern</button>
          <span id="se-ltv-msg" style="display:none;margin-left:.75rem;font-size:12px;color:var(--ok)">&#10003; Gespeichert.</span>
        </div>
      </div>

      <div class="card" style="margin-bottom:1rem">
        <span class="card-title">Countdown-Warnung</span>
        <p class="note2" style="margin-bottom:.75rem">Kredite werden im Countdown-Banner angezeigt, wenn sie innerhalb dieser Anzahl Tage f&#228;llig werden.</p>
        <div class="fg" style="margin-top:.75rem">
          <div class="ff">
            <label>Tage bis F&#228;lligkeit (Warnschwelle)</label>
            <input type="number" id="se-countdown" min="1" max="365" step="1" placeholder="30">
          </div>
        </div>
        <div style="margin-top:.75rem">
          <button class="sm primary" onclick="d.seCountdownSave()">&#10003; Speichern</button>
          <span id="se-countdown-msg" style="display:none;margin-left:.75rem;font-size:12px;color:var(--ok)">&#10003; Gespeichert.</span>
        </div>
      </div>

      <div class="card" style="border:1px solid var(--err-border);background:var(--err-bg)">
        <span class="card-title" style="color:var(--err)">&#9888; Gefahrenzone</span>
        <p class="note2" style="margin-bottom:.75rem">Alle Daten unwiderruflich l&#246;schen und das Dashboard in den Ausgangszustand zur&#252;cksetzen.</p>
        <div style="display:flex;flex-direction:column;gap:.5rem">
          <div style="display:flex;align-items:center;justify-content:space-between;padding:.6rem .75rem;background:var(--bg);border-radius:8px;border:1px solid var(--err-border)">
            <div>
              <div style="font-size:13px;font-weight:600;color:var(--text)">Alle Kredite l&#246;schen</div>
              <div style="font-size:11px;color:var(--text3);margin-top:2px">Entfernt alle Kredite. Einstellungen bleiben erhalten.</div>
            </div>
            <button class="sm" onclick="d.openReset('loans')" style="background:var(--err);color:#fff;border-color:var(--err);flex-shrink:0;margin-left:1rem">L&#246;schen</button>
          </div>
          <div style="display:flex;align-items:center;justify-content:space-between;padding:.6rem .75rem;background:var(--bg);border-radius:8px;border:1px solid var(--err-border)">
            <div>
              <div style="font-size:13px;font-weight:600;color:var(--text)">Einstellungen zur&#252;cksetzen</div>
              <div style="font-size:11px;color:var(--text3);margin-top:2px">Setzt alle Einstellungen auf Standardwerte. Kredite bleiben erhalten.</div>
            </div>
            <button class="sm" onclick="d.openReset('settings')" style="background:var(--err);color:#fff;border-color:var(--err);flex-shrink:0;margin-left:1rem">Zur&#252;cksetzen</button>
          </div>
          <div style="display:flex;align-items:center;justify-content:space-between;padding:.6rem .75rem;background:var(--bg);border-radius:8px;border:1px solid var(--err-border)">
            <div>
              <div style="font-size:13px;font-weight:600;color:var(--text)">Alles zur&#252;cksetzen</div>
              <div style="font-size:11px;color:var(--text3);margin-top:2px">L&#246;scht alle Kredite und setzt alle Einstellungen zur&#252;ck.</div>
            </div>
            <button class="sm" onclick="d.openReset('all')" style="background:var(--err);color:#fff;border-color:var(--err);flex-shrink:0;margin-left:1rem">Alles zur&#252;cksetzen</button>
          </div>
        </div>
      </div>
    </div>

    <!-- ── RESET CONFIRM MODAL ── -->
    <div class="modal-bg" id="reset-modal-bg" onclick="if(event.target===this)d.closeReset()">
      <div class="modal" style="max-width:400px">
        <div class="modal-title">
          <span id="reset-modal-title">Zur&#252;cksetzen</span>
          <button class="modal-close" onclick="d.closeReset()">&#10005;</button>
        </div>
        <p id="reset-modal-desc" style="font-size:13px;color:var(--text2);margin:0 0 .75rem"></p>
        <div style="padding:.65rem .85rem;border-radius:8px;background:var(--err-bg);border:1px solid var(--err-border);font-size:12px;color:var(--err);margin-bottom:1.25rem">
          &#9888; Diese Aktion kann nicht r&#252;ckg&#228;ngig gemacht werden.
        </div>
        <div class="modal-actions">
          <button class="sm" onclick="d.closeReset()">Abbrechen</button>
          <button class="sm" id="reset-confirm-btn" onclick="d.confirmReset()" style="background:var(--err);color:#fff;border-color:var(--err)">Best&#228;tigen</button>
        </div>
      </div>
    </div>

    <!-- DELETE CONFIRM MODAL -->
    <div class="modal-bg" id="del-modal-bg" onclick="if(event.target===this)d.closeDel()">
      <div class="modal" style="max-width:400px">
        <div class="modal-title">
          <span>Kredit l&#246;schen</span>
          <button class="modal-close" onclick="d.closeDel()">&#10005;</button>
        </div>
        <p style="font-size:14px;color:var(--text2);margin:0 0 .5rem">Soll dieser Kredit wirklich gel&#246;scht werden?</p>
        <p id="del-modal-name" style="font-size:15px;font-weight:700;color:var(--text);margin:0 0 1.1rem"></p>
        <p style="font-size:12px;color:var(--text4);margin:0 0 1rem">Diese Aktion kann nicht r&#252;ckg&#228;ngig gemacht werden.</p>
        <div class="modal-actions">
          <button class="sm" onclick="d.closeDel()">Abbrechen</button>
          <button class="sm" onclick="d.confirmDel()" style="background:var(--err);color:#fff;border-color:var(--err)">L&#246;schen</button>
        </div>
      </div>
    </div>

    </div><!-- .main -->
    </div><!-- .layout -->

    <!-- ── IMPORT STRATEGY MODAL ── -->
    <div class="modal-bg" id="import-modal-bg" onclick="if(event.target===this)d.closeImport()">
      <div class="modal" style="max-width:420px">
        <div class="modal-title">
          <span id="import-modal-title">&#8593; Import</span>
          <button class="modal-close" onclick="d.closeImport()">&#10005;</button>
        </div>
        <p class="note2" style="margin-bottom:1rem">Wie sollen importierte Kredite behandelt werden?</p>
        <div style="display:flex;flex-direction:column;gap:.5rem;margin-bottom:1.25rem">
          <button class="import-strat-btn" data-strat="merge" onclick="d.pickImportStrat('merge',this)">
            <span style="font-size:15px">&#10133;</span>
            <div><div style="font-weight:600">Zusammenf&#252;hren</div><div class="note2" style="margin:0">Alle importierten Kredite werden hinzugef&#252;gt</div></div>
          </button>
          <button class="import-strat-btn" data-strat="skip" onclick="d.pickImportStrat('skip',this)">
            <span style="font-size:15px">&#10145;</span>
            <div><div style="font-weight:600">Duplikate &#252;berspringen</div><div class="note2" style="margin:0">Kredite mit gleicher ID werden nicht nochmals importiert</div></div>
          </button>
          <button class="import-strat-btn" data-strat="replace" onclick="d.pickImportStrat('replace',this)">
            <span style="font-size:15px">&#9888;</span>
            <div><div style="font-weight:600">Ersetzen</div><div class="note2" style="margin:0">Alle bestehenden Kredite werden gel&#246;scht und durch die importierten ersetzt</div></div>
          </button>
        </div>
        <div class="modal-actions">
          <button class="sm" onclick="d.closeImport()">Abbrechen</button>
          <label for="import-file-json" id="import-confirm-btn" class="import-confirm-label" style="display:none">JSON w&#228;hlen &#8594;</label>
          <label for="import-file-csv" id="import-confirm-btn-csv" class="import-confirm-label" style="display:none">CSV w&#228;hlen &#8594;</label>
        </div>
      </div>
    </div>

    <div class="mobile-footer-end">Firefish Dashboard <a href="https://github.com/thesatoshivan/firefish-dashboard-unofficial/blob/main/changelog.md#v130-22032026" target="_blank" style="text-decoration:none;color:var(--text3)">v1.3.0</a><br>Inoffizielles Tool — nicht verbunden mit firefish.io<br><a href="https://github.com/thesatoshivan" target="_blank">🔗 GitHub</a> &nbsp;·&nbsp; <a href="https://x.com/TheSatoshiVan" target="_blank">𝕏 @TheSatoshiVan</a></div>
    </div><!-- #ffd-root -->

    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>
    (function(){
    'use strict';
    var R={BTC:85000,EUR:1.08,CHF:1.12,CZK:0.043,PLN:0.25,USDC:1,USDT:1,USD:1,SAT:85000/1e8};
    /* ── Hardcoded BTC price history (2022-01-01 → 2025-12-31) ──────────────────
       Approximate monthly-interpolated closing prices, rounded to nearest $100.
       Stored as int16/100 array: multiply by 100 to get USD.
       Base date: 2022-01-01 = index 0. Falls back to CoinGecko API if date not covered.
    ───────────────────────────────────────────────────────────────────────────── */
    var BTC_HIST_BASE='2022-01-01';
    var BTC_HIST_END='2025-12-31';
    var BTC_HIST_PRICES=[0,4769,4686,4602,4519,4436,4353,4270,4187,4204,4222,4239,4257,4274,4292,4310,4222,4134,4046,3958,3870,3782,3694,3704,3715,3726,3737,3748,3759,3769,3863,3956,4049,4142,4235,4328,4421,4393,4365,4336,4308,4280,4252,4223,4167,4112,4056,4000,3944,3888,3832,3844,3855,3866,3877,3889,3900,3911,3901,3891,3881,3871,3861,3851,3841,3846,3851,3857,3862,3867,3872,3877,3921,3965,4009,4053,4097,4141,4185,4260,4334,4409,4483,4557,4632,4706,4698,4690,4682,4674,4665,4657,4649,4587,4526,4464,4403,4341,4279,4218,4194,4171,4148,4125,4102,4079,4056,4044,4031,4019,4007,3994,3982,3970,3940,3910,3881,3851,3821,3792,3762,3732,3702,3672,3643,3613,3583,3553,3461,3369,3277,3184,3092,3000,2908,2913,2918,2923,2929,2934,2939,2944,2978,3011,3045,3079,3112,3146,3179,3152,3125,3098,3071,3044,3018,2991,2936,2881,2826,2771,2716,2661,2606,2528,2450,2372,2294,2216,2138,2060,2068,2077,2085,2094,2102,2110,2119,2099,2079,2059,2039,2019,1999,1978,1999,2019,2039,2060,2080,2100,2120,2152,2183,2214,2245,2277,2308,2339,2308,2277,2245,2214,2183,2151,2120,2155,2190,2224,2259,2294,2329,2364,2365,2367,2369,2370,2372,2374,2375,2385,2394,2403,2412,2422,2431,2440,2399,2359,2318,2277,2236,2196,2155,2133,2112,2091,2069,2048,2026,2005,2003,2000,1998,1996,1993,1991,1989,2024,2060,2095,2130,2166,2201,2237,2195,2153,2111,2069,2026,1984,1942,1942,1943,1943,1943,1943,1943,1943,1945,1947,1949,1951,1953,1955,1957,1955,1953,1951,1949,1947,1945,1943,1945,1947,1948,1950,1952,1954,1956,1973,1991,2009,2026,2044,2062,2079,2075,2071,2066,2062,2058,2054,2049,2058,2067,2076,2085,2093,2102,2111,2049,1987,1925,1862,1800,1738,1676,1668,1661,1653,1645,1637,1630,1622,1625,1629,1632,1636,1639,1643,1646,1656,1666,1676,1687,1697,1707,1717,1717,1717,1718,1718,1719,1719,1719,1710,1701,1692,1682,1673,1664,1655,1659,1663,1667,1671,1675,1679,1683,1679,1674,1669,1664,1660,1655,1663,1671,1678,1686,1694,1702,1710,1718,1773,1829,1884,1940,1995,2051,2107,2134,2162,2189,2216,2244,2271,2299,2312,2324,2337,2350,2362,2375,2388,2374,2361,2348,2334,2321,2308,2294,2278,2262,2246,2229,2213,2197,2180,2221,2261,2302,2342,2382,2423,2463,2442,2421,2400,2378,2357,2336,2315,2305,2294,2284,2274,2264,2253,2243,2271,2299,2327,2356,2384,2412,2440,2487,2534,2582,2629,2676,2723,2771,2774,2778,2782,2786,2790,2794,2797,2805,2812,2819,2826,2833,2840,2847,2864,2880,2896,2913,2929,2946,2962,2974,2985,2997,3009,3021,3032,3044,3005,2965,2926,2886,2847,2807,2768,2790,2812,2835,2857,2879,2902,2924,2927,2931,2934,2938,2941,2945,2949,2911,2873,2835,2797,2759,2721,2683,2684,2685,2685,2686,2687,2688,2688,2700,2711,2722,2734,2745,2756,2767,2761,2754,2748,2741,2735,2728,2722,2711,2701,2690,2680,2669,2658,2648,2674,2699,2725,2751,2777,2802,2828,2860,2891,2922,2954,2985,3016,3048,3054,3060,3066,3072,3078,3084,3090,3081,3073,3064,3055,3046,3037,3029,3022,3016,3009,3003,2996,2990,2983,2975,2966,2957,2949,2940,2932,2923,2923,2923,2923,2923,2923,2923,2923,2929,2936,2942,2948,2954,2961,2967,2963,2959,2955,2951,2947,2943,2939,2891,2843,2795,2747,2699,2652,2604,2604,2604,2604,2604,2604,2605,2605,2603,2601,2600,2598,2596,2595,2593,2596,2599,2603,2606,2609,2612,2615,2621,2627,2633,2639,2645,2651,2657,2652,2647,2642,2637,2632,2627,2622,2633,2644,2656,2667,2678,2690,2701,2715,2728,2742,2755,2769,2783,2796,2804,2812,2820,2828,2836,2844,2852,2924,2995,3067,3138,3210,3282,3353,3367,3381,3395,3409,3423,3437,3451,3459,3466,3474,3481,3489,3496,3504,3542,3581,3619,3658,3696,3735,3773,3768,3764,3759,3754,3749,3745,3740,3745,3749,3754,3759,3764,3768,3773,3829,3884,3940,3996,4051,4107,4163,4161,4159,4156,4154,4152,4150,4148,4159,4171,4182,4193,4204,4215,4227,4246,4266,4286,4306,4326,4345,4365,4345,4326,4306,4286,4266,4246,4227,4254,4281,4308,4335,4362,4389,4416,4393,4369,4346,4323,4300,4276,4253,4210,4167,4124,4080,4037,3994,3951,4008,4065,4122,4178,4235,4292,4349,4335,4322,4308,4294,4280,4267,4253,4333,4413,4493,4574,4654,4734,4814,4866,4919,4971,5024,5076,5129,5181,5255,5330,5404,5478,5552,5627,5701,5778,5854,5931,6008,6085,6161,6238,6367,6496,6625,6754,6883,7012,7142,7087,7031,6976,6921,6866,6811,6756,6730,6704,6678,6652,6625,6599,6573,6653,6732,6812,6892,6971,7051,7130,7146,7162,7177,7193,7209,7224,7240,7118,6995,6873,6751,6628,6506,6384,6398,6413,6427,6442,6456,6471,6486,6469,6453,6436,6420,6403,6387,6370,6326,6282,6238,6195,6151,6107,6063,6073,6082,6091,6101,6110,6120,6129,6210,6292,6373,6454,6535,6616,6697,6716,6735,6754,6772,6791,6810,6829,6818,6808,6797,6787,6777,6766,6756,6783,6809,6836,6863,6890,6916,6943,6884,6825,6765,6706,6647,6587,6528,6470,6412,6354,6296,6238,6180,6122,6154,6187,6220,6252,6285,6317,6350,6257,6164,6072,5979,5886,5793,5701,5713,5725,5737,5749,5761,5772,5784,5927,6070,6212,6355,6497,6640,6782,6769,6755,6742,6729,6715,6702,6689,6607,6525,6443,6361,6279,6197,6115,6109,6103,6097,6091,6085,6079,6073,6051,6029,6007,5984,5962,5940,5918,5990,6063,6136,6208,6281,6354,6426,6351,6275,6199,6124,6048,5973,5897,5869,5840,5812,5784,5756,5727,5699,5719,5739,5759,5779,5799,5819,5839,5909,5980,6050,6120,6190,6261,6331,6366,6401,6435,6470,6505,6540,6574,6530,6485,6441,6396,6351,6307,6262,6311,6360,6409,6457,6506,6555,6604,6653,6702,6751,6800,6848,6897,6946,6988,7029,7070,7111,7153,7194,7235,7292,7350,7407,7465,7522,7580,7637,7817,7998,8178,8358,8538,8719,8899,8923,8948,8973,8997,9022,9046,9071,9180,9290,9400,9510,9620,9729,9839,9811,9784,9756,9728,9700,9673,9645,9691,9736,9782,9828,9874,9920,9966,10039,10113,10186,10260,10333,10407,10480,10346,10211,10077,9943,9809,9674,9540,9512,9484,9456,9427,9399,9371,9343,9413,9482,9456,9696,9817,9822,9835,10225,9693,9507,9254,9472,9461,9454,9454,9654,10050,10001,10409,10454,10132,10220,10616,10369,10391,10486,10474,10264,10209,10135,10372,10473,10242,10065,9769,10134,9779,9660,9657,9651,9645,9647,9744,9577,9788,9661,9751,9757,9613,9578,9564,9665,9831,9616,9656,9626,9151,8869,8421,8472,8438,8607,9427,8621,8727,9061,8993,8653,8622,8069,7858,8292,8366,8110,8398,8434,8258,8402,8272,8684,8421,8407,8384,8608,8749,8740,8691,8723,8441,8265,8237,8255,8516,8253,8316,8387,8355,7839,7916,7631,8261,7961,8341,8529,8373,8459,8365,8403,8494,8448,8507,8518,8752,9344,9370,9398,9468,9463,9374,9500,9427,9418,9650,9689,9589,9432,9475,9683,9704,10327,10298,10480,10412,10280,10412,10351,10377,10348,10311,10651,10559,10682,10964,11170,10731,10776,10902,10946,10894,10779,10560,10398,10460,10564,10585,10581,10470,10152,10431,10556,10574,11027,11027,10866,10570,10608,10542,10559,10674,10456,10489,10467,10328,10211,10099,10538,10608,10735,10695,10704,10730,10836,10717,10569,10884,10960,10799,10821,10921,10827,10891,11125,11599,11754,11742,11909,11985,11776,11868,11920,11794,11785,11730,11739,11997,11876,11831,11763,11792,11940,11805,11795,11784,11577,11331,11255,11421,11506,11414,11500,11748,11668,11647,11929,11869,12015,12332,11831,11736,11741,11741,11620,11288,11428,11248,11693,11543,11348,11012,11177,11126,11257,10836,10882,10823,10924,11122,11172,11071,11065,11019,11115,11207,11152,11396,11549,11604,11593,11532,11536,11680,11643,11709,11565,11570,11524,11267,11200,11331,10902,10966,10965,11218,11436,11405,11858,12057,12222,12239,12348,12473,12136,12331,12167,11288,11067,11499,11518,11303,11077,10821,10644,10719,10866,11054,10834,10759,11008,11101,11165,11455,11411,11291,11003,10832,10960,11010,11059,10658,10150,10390,10133,10333,10231,10472,10601,10305,10166,9973,9455,9559,9426,9220,9296,9154,8661,8513,8472,8683,8830,8737,9050,9133,9090,9080,9037,8631,9129,9344,9208,8933,8921,9041,9064,9269,9200,9251,9027,9025,8816,8643,8785,8623,8551,8813,8836,8864,8855,8747,8766,8725,8736,8785,8790,8722,8847,8761];
    /* Lookup helper: returns hardcoded price (×10) or null if date not covered */
    function btcHistLocal(dateISO){
      if(!dateISO)return null;
      var baseT=new Date(BTC_HIST_BASE).getTime();
      var t=new Date(dateISO).getTime();
      var idx=Math.round((t-baseT)/86400000);
      if(idx<0||idx>=BTC_HIST_PRICES.length)return null;
      return BTC_HIST_PRICES[idx]*10;
    }
    var liveBtc=null,btc24hChange=null,calY=new Date().getFullYear(),calM=new Date().getMonth();
    /* Shared helper: renders currency/value pairs as a compact 2-col grid */
    function cGrid(pairs){
      if(!pairs||!pairs.length)return '';
      return '<div style="display:grid;grid-template-columns:1fr 1fr;gap:1px 8px;margin-top:2px">'+
        pairs.map(function(p){return '<div><span style="color:var(--text4);font-weight:600">'+p.c+'</span> '+p.v.toLocaleString('de-CH',{maximumFractionDigits:0})+'</div>';}).join('')+
      '</div>';
    }
    function usdGrid(ccys,usd){
      return cGrid(ccys.filter(function(c){return c!=='BTC'&&c!=='SAT';}).map(function(c){return {c:c,v:frU(usd,c)};}));
    }
    var chD=null,chI=null,dCcy='USD';
    var chLtv=null,chMcd=null,chCol=null,chCcy=null,chBep=null,chInt2=null,chBtcost=null,chCf=null,chDcol=null,chHeat=null,chTerm=null,chZukunft=null,chZinslast=null;
    var lSort={key:'dl',dir:1};
    var ltvThresh=parseInt(localStorage.getItem('ffd_ltv_thresh'))||80;
    var lFilter='active';
    var lCcyFilter='all';
    var lView='grid';
    var STORE_KEY='ffd_loans';
    function save(){try{localStorage.setItem(STORE_KEY,JSON.stringify(loans));}catch(e){}}
    function load(){try{var s=localStorage.getItem(STORE_KEY);if(s){var p=JSON.parse(s);if(Array.isArray(p)){loans=p;return;}}}catch(e){}loans=[];}
    load();
    load();
    var loans=loans;
    var ALL_CCYS=['EUR','CHF','USD','USDT','USDC','CZK','PLN','BTC','SAT'];
    var SETTINGS_KEY='ffd_settings';
    function loadSettings(){
      try{
        var s=localStorage.getItem(SETTINGS_KEY);
        if(s){
          var p=JSON.parse(s);
          if(p&&p.ccys){
            return {
              ccys: p.ccys||['EUR','CHF','USD','BTC'],
              defaultTab: p.defaultTab||'ov',
              defaultView: p.defaultView||'grid',
              defaultCcy: p.defaultCcy||'EUR',
              ltvWarn: p.ltvWarn!=null?p.ltvWarn:73,
              ltvCrit: p.ltvCrit!=null?p.ltvCrit:79,
              ltvDanger: p.ltvDanger!=null?p.ltvDanger:86,
              ltvDisplay: p.ltvDisplay!=null?p.ltvDisplay:73,
              countdownDays: p.countdownDays!=null?p.countdownDays:30,
              hideAmounts: p.hideAmounts||false,
              hideBreakEven: p.hideBreakEven||false,
              navOrder: p.navOrder||null,
              darkMode: p.darkMode||false
            };
          }
        }
      }catch(e){}
      return{ccys:['EUR','CHF','USD','BTC'],defaultTab:'ov',defaultView:'grid',defaultCcy:'EUR',ltvWarn:73,ltvCrit:79,ltvDanger:86,ltvDisplay:73,countdownDays:30,hideAmounts:false,hideBreakEven:false,navOrder:null,darkMode:false};
    }
    function saveSettings(cfg){try{localStorage.setItem(SETTINGS_KEY,JSON.stringify(cfg));}catch(e){}}
    var cfg=loadSettings();
    function visC(c){return cfg.ccys.indexOf(c)>=0;}
    /* Apply cfg defaults */
    ltvThresh=cfg.ltvDisplay||73;
    lView=cfg.defaultView||'grid';

    function g(id){return document.getElementById(id);}
    function toU(a,c){return a*(R[c]||1);}
    function frU(u,c){return c==='BTC'?u/R.BTC:c==='SAT'?(u/R.BTC)*1e8:u/(R[c]||1);}
    function intU(l){return toU(l.amount*(l.rate/100)*(l.term/12),l.c);}
    function feeU(l){return (l.feeBtc||0)*R.BTC;}
    function dueU(l){return toU(l.amount,l.c)+intU(l)+feeU(l);}
    function aM(ds,m){var d=new Date(ds);d.setMonth(d.getMonth()+m);return d;}
    function dL(ds,m){return Math.ceil((aM(ds,m)-new Date())/864e5);}
    /* Auto-close loans whose end date has passed */
    function syncStatus(){loans.forEach(function(l){if(l.status==='active'&&dL(l.start,l.term)<=0)l.status='closed';});}
    window.goRo=function(){
      /* Try visible nav-item first (desktop sidebar), then mobile tab bar */
      var all=document.querySelectorAll('#ffd-root .nav-item, #ffd-root .tab');
      for(var i=0;i<all.length;i++){
        var oc=all[i].getAttribute('onclick')||'';
        if(oc.indexOf("'ro'")>=0){
          d.tab('ro',all[i]);
          return;
        }
      }
    };
    function uid(){return'FF-'+Math.random().toString(36).slice(2,7).toUpperCase();}
    function lc(v){return v<73?'#16a34a':v<79?'#d97706':v<86?'#ea580c':'#dc2626';}
    function fmt(a,c){
      if(c==='BTC')return a.toFixed(8)+' BTC';
      if(c==='SAT')return a.toLocaleString('de-CH',{maximumFractionDigits:0})+' sats';
      if(c==='CZK')return 'Kč '+a.toLocaleString('de-CH',{maximumFractionDigits:0});
      if(c==='PLN')return 'zł '+a.toLocaleString('de-CH',{maximumFractionDigits:0});
      var s={EUR:'€',CHF:'Fr.',USD:'$',USDC:'USDC ',USDT:'USDT '}[c]||c+' ';
      return s+a.toLocaleString('de-CH',{minimumFractionDigits:0,maximumFractionDigits:0});
    }
    function fax(v,c){
      if(c==='SAT'){if(v>=1e6)return(v/1e6).toFixed(1)+'M';if(v>=1e3)return(v/1e3).toFixed(0)+'k';return v.toFixed(0);}
      if(c==='BTC')return v.toFixed(8)+' ₿';
      var s={EUR:'€',CHF:'Fr.',USD:'$',USDC:'USDC ',USDT:'USDT ',CZK:'Kč ',PLN:'zł '}[c]||'';
      if(v>=1e6)return s+(v/1e6).toFixed(2)+'M';
      if(v>=1e3)return s+(v/1e3).toFixed(0)+'k';
      return s+v.toLocaleString('de-CH',{maximumFractionDigits:0});
    }
    function pills(){
      var pbtc=g('p-btc');
      console.log('[pills] R.BTC =', R.BTC, '| liveBtc =', liveBtc, '| p-btc element =', pbtc, '| all p-btc =', document.querySelectorAll('#p-btc').length);
      if(pbtc) pbtc.value=Math.round(R.BTC);
      g('p-eur').value=R.EUR.toFixed(4);
      g('p-chf').value=R.CHF.toFixed(4);
      /* BTC price in visible fiat currencies — editable */
      var FIATS=['EUR','CHF','CZK','PLN'];
      var labels={EUR:'€',CHF:'Fr.',USD:'$',CZK:'Kč',PLN:'zł'};
      var el=g('pills-btc-fiats');
      if(!el)return;
      el.innerHTML=FIATS.filter(visC).map(function(c){
        var price=Math.round(frU(R.BTC,c));
        return '<span class="pill">BTC/'+labels[c]+'<input type="number" data-ccy="'+c+'" title="BTC/'+c+' bearbeiten" oninput="d.rateFiat(this)" step="1" value="'+price+'" style="width:80px"></span>';
      }).join('');
    }
    function ccyG(ccys,usd){
      return '<div class="ccyg">'+ccys.filter(visC).map(function(c){return '<div class="ccyc"><span class="ccy-lbl">'+c+'</span><span class="ccy-val">'+fmt(frU(usd,c),c)+'</span></div>';}).join('')+'</div>';
    }

    window.d={
      rate:function(){
        var b=parseFloat(g('p-btc').value),e=parseFloat(g('p-eur').value),c=parseFloat(g('p-chf').value);
        if(b>0){R.BTC=b;R.SAT=b/1e8;}if(e>0)R.EUR=e;if(c>0)R.CHF=c;
        pills();d.checkAlarms();
        var at=document.querySelector('#ffd-root .tab.on');
        if(at){var t=at.getAttribute('onclick').match(/'([^']+)'/)[1];if(t==='ov')d.ov();if(t==='st')d.stress();if(t==='tl')d.tl();if(t==='lo')d.loans();}
      },
      rateFiat:function(input){
        var c=input.dataset.ccy;
        var v=parseFloat(input.value);
        if(!v||v<=0)return;
        /* Convert fiat BTC price back to USD */
        R.BTC=toU(v,c);
        R.SAT=R.BTC/1e8;
        g('p-btc').value=Math.round(R.BTC);
        /* Update other fiat inputs without re-rendering whole pills */
        document.querySelectorAll('#pills-btc-fiats input[data-ccy]').forEach(function(inp){
          if(inp.dataset.ccy!==c)inp.value=Math.round(frU(R.BTC,inp.dataset.ccy));
        });
        d.checkAlarms();
        var at=document.querySelector('#ffd-root .tab.on');
        if(at){var t=at.getAttribute('onclick').match(/'([^']+)'/)[1];if(t==='ov')d.ov();if(t==='st')d.stress();if(t==='tl')d.tl();if(t==='lo')d.loans();}
      },
      live:function(){if(liveBtc){R.BTC=liveBtc;R.SAT=liveBtc/1e8;pills();d.ov();}},
      updateHdrStats:function(){
        var act=loans.filter(function(l){return l.status==='active';});
        var dash='–';
        /* Active count */
        var acEl=g('hdr-act-count');
        if(acEl)acEl.textContent=act.length+'';
        /* Next due */
        var ndEl=g('hdr-next-due');
        if(ndEl){
          var sorted=act.slice().sort(function(a,b){return dL(a.start,a.term)-dL(b.start,b.term);});
          var nd=sorted[0]||null;
          if(nd){
            var days=dL(nd.start,nd.term);
            var col=days<=7?'var(--err)':days<=30?'var(--warn)':'var(--text)';
            var ndAmt=toU(nd.amount,nd.c)+intU(nd);
            var ndAmtStr=fmt(frU(ndAmt,'USD'),'USD');
            ndEl.innerHTML='<span style="color:'+col+'">'+days+'d</span>'+
              ' <span style="font-weight:400;font-size:11px;color:var(--text3)">'+nd.name+'</span>';
            var ndTtEl=g('hdr-next-due-tooltip');
            if(ndTtEl)ndTtEl.innerHTML='<span style="color:'+col+'">Fälliger Betrag: '+ndAmtStr+'</span>';
          } else { ndEl.textContent=dash; }
        }
        /* Collateral value */
        var cvEl=g('hdr-col-val'),ctEl=g('hdr-col-tooltip'),cbEl=g('hdr-col-btc');
        if(cvEl){
          var aC=act.reduce(function(s,l){return s+l.col;},0);
          var colUSD=aC*R.BTC;
          if(cbEl)cbEl.textContent=aC>0?(aC.toFixed(6)+' ₿'):dash;
          cvEl.textContent=colUSD>0?('$'+Math.round(colUSD).toLocaleString('de-CH')):dash;
          if(ctEl&&colUSD>0){
            var CC=(['EUR','CHF','USD','USDT','USDC','CZK','PLN']).filter(visC).filter(function(c){return c!=='USD';});
            ctEl.innerHTML=CC.map(function(c){return '<b>'+c+'</b> '+fmt(frU(colUSD,c),c);}).join('<br>');
          }
        }
        /* Offene Schuld */
        var dueEl=g('hdr-due-val'),dueTtEl=g('hdr-due-tooltip'),dueBtcEl=g('hdr-due-btc');
        if(dueEl){
          var aDue=act.reduce(function(s,l){return s+toU(l.amount,l.c)+intU(l);},0);
          dueEl.textContent=aDue>0?('$'+Math.round(aDue).toLocaleString('de-CH')):dash;
          if(dueBtcEl){dueBtcEl.textContent=aDue>0&&R.BTC>0?('₿'+(aDue/R.BTC).toFixed(4)):dash;}
          if(dueTtEl&&aDue>0){
            var CC2=(['EUR','CHF','USD','USDT','USDC','CZK','PLN']).filter(visC).filter(function(c){return c!=='USD';});
            dueTtEl.innerHTML=CC2.map(function(c){return '<b>'+c+'</b> '+fmt(frU(aDue,c),c);}).join('<br>');
          }
        }
        /* BTC 24h */
        var b24El=g('hdr-btc-24h');
        if(b24El){
          if(btc24hChange!==null){
            var pos=btc24hChange>=0;
            b24El.innerHTML='<span style="color:'+(pos?'var(--ok)':'var(--err)')+'">'+(pos?'▲':'▼')+' '+(pos?'+':'')+btc24hChange.toFixed(2)+'%</span>';
          } else { b24El.textContent=dash; }
        }
        /* MC distance — show next unbreached threshold per loan */
        var mc1El=g('hdr-mc1-dist'),mc1tEl=g('hdr-mc1-tooltip');
        if(mc1El){
          var withCol=act.filter(function(l){return l.col>0;});
          if(withCol.length){
            var mc1Pct=cfg.ltvWarn!=null?cfg.ltvWarn/100:0.73;
            var mc2Pct=cfg.ltvCrit!=null?cfg.ltvCrit/100:0.79;
            var mc3Pct=cfg.ltvDanger!=null?cfg.ltvDanger/100:0.86;
            var liqPct=0.95;
            var thresholds=[
              {lbl:'MC1',pct:mc1Pct},
              {lbl:'MC2',pct:mc2Pct},
              {lbl:'MC3',pct:mc3Pct},
              {lbl:'Liq.',pct:liqPct}
            ];
            /* For each loan: find next unbreached threshold */
            var loanItems=withCol.map(function(l){
              var due=toU(l.amount,l.c)+intU(l);
              var ltv=due/(l.col*R.BTC);
              var next=null;
              for(var ti=0;ti<thresholds.length;ti++){
                if(ltv<thresholds[ti].pct){next=thresholds[ti];break;}
              }
              if(!next)next=thresholds[thresholds.length-1]; /* already past liq */
              var price=due/(next.pct*l.col);
              var dist=(R.BTC-price)/R.BTC*100;
              return {name:l.name,lbl:next.lbl,price:price,dist:dist,ltv:ltv,breached:ltv>=liqPct};
            });
            /* Show the loan closest to (or past) its next threshold */
            var nearest=loanItems.reduce(function(a,b){return a.dist<b.dist?a:b;});
            var col=nearest.dist<0?'var(--err)':nearest.dist<5?'var(--err)':nearest.dist<15?'var(--warn)':'var(--ok)';
            mc1El.innerHTML=
              '<span style="color:'+col+'">'+nearest.dist.toFixed(1)+'%</span>'+
              ' <span style="font-weight:400;font-size:11px;color:var(--text3)">'+nearest.lbl+' ($'+Math.round(nearest.price).toLocaleString('de-CH')+') '+nearest.name+'</span>';
            if(mc1tEl){
              mc1tEl.innerHTML=loanItems.slice().sort(function(a,b){return a.dist-b.dist;}).map(function(x){
                var c=x.dist<0?'var(--err)':x.dist<5?'var(--err)':x.dist<15?'var(--warn)':'var(--ok)';
                return '<b>'+x.name+'</b> → '+x.lbl+' <span style="color:'+c+'">'+x.dist.toFixed(1)+'%</span> ($'+Math.round(x.price).toLocaleString('de-CH')+')';
              }).join('<br>');
            }
          } else { mc1El.textContent=dash; }
        }
        /* Break-even BTC (alle Kredite: aktiv + abgeschlossen) */
        var bepEl=g('hdr-bep'),bepTtEl=g('hdr-bep-tooltip');
        if(bepEl){
          var bepLoans=loans.filter(function(l){return l.col>0;});
          if(bepLoans.length){
            /* Per-loan break-even: btcStart + costUSD / colBtc */
            var bepItems=bepLoans.map(function(l){
              var bs=l.btcStart||R.BTC;
              var costUSD=intU(l)+feeU(l);
              return {name:l.name,status:l.status,bep:bs+costUSD/l.col};
            });
            /* Portfolio break-even: weighted by collateral */
            var totalCol=bepLoans.reduce(function(s,l){return s+l.col;},0);
            var totalCost=bepLoans.reduce(function(s,l){return s+intU(l)+feeU(l);},0);
            var avgBtcStart=bepLoans.reduce(function(s,l){return s+(l.btcStart||R.BTC)*l.col;},0)/totalCol;
            var portfolioBep=avgBtcStart+totalCost/totalCol;
            var bepDist=((R.BTC-portfolioBep)/R.BTC*100);
            var bepAbove=bepDist>=0;
            var bepCol=bepAbove?'var(--ok)':'var(--err)';
            bepEl.innerHTML=
              '<span style="color:'+bepCol+'">'+(bepAbove?'+':'')+bepDist.toFixed(1)+'%</span>'+
              ' <span style="font-weight:400;font-size:11px;color:var(--text3)">$'+Math.round(portfolioBep).toLocaleString('de-CH')+'</span>';
            if(bepTtEl){
              bepTtEl.innerHTML=bepItems.slice().sort(function(a,b){return a.bep-b.bep;}).map(function(x){
                var d=((R.BTC-x.bep)/R.BTC*100);
                var c=d>=0?'var(--ok)':'var(--err)';
                var badge=x.status==='active'?'<span style="color:var(--ok);font-size:10px">&#9679;</span> ':'<span style="color:var(--text4);font-size:10px">&#9675;</span> ';
                return badge+'<b>'+x.name+'</b> <span style="color:'+c+'">'+(d>=0?'+':'')+d.toFixed(1)+'%</span> ($'+Math.round(x.bep).toLocaleString('de-CH')+')';
              }).join('<br>');
            }
          } else { bepEl.textContent=dash; }
        }
      },
      tab:function(t,el){
        document.querySelectorAll('#ffd-root .tab').forEach(function(b){b.classList.remove('on');});
        document.querySelectorAll('#ffd-root .nav-item').forEach(function(b){b.classList.remove('on');});
        document.querySelectorAll('#ffd-root .sec').forEach(function(s){s.classList.remove('on');s.style.display='none';});
        /* activate both the clicked element and its twin (tab or nav-item) */
        if(el){
          var attr=el.getAttribute('onclick');
          document.querySelectorAll('#ffd-root .tab, #ffd-root .nav-item').forEach(function(b){
            if(b.getAttribute('onclick')===attr)b.classList.add('on');
          });
        }
        var sec=g('s-'+t);
        sec.classList.add('on');
        sec.style.display=(t==='to')?'flex':'grid';
        /* write hash without triggering scroll */
        try{history.replaceState(null,'','#'+t);}catch(e){location.hash=t;}
        syncStatus();d.checkAlarms();d.updateHdrStats();
        var fn={ov:d.ov,lo:d.loans,st:d.stress,ca:d.cal,tl:d.tl,ch:d.ch,sx:d.sx,se:d.se,ro:d.ro,to:d.vorInit,wae:function(){d.nachPopulate();d.nlpPopulate();d.se2Populate();d.gvlPopulate();d.nlpPopulate();},zukunft:function(){var el=g('zk-btc');if(el&&!el.value&&R.BTC)el.value=Math.round(R.BTC);d.zukunft();}};if(fn[t])fn[t]();
      },
      toolTab:function(t,el){
        document.querySelectorAll('#ffd-root .filter-tabs .filter-tab').forEach(function(b){b.classList.remove('on');});
        el.classList.add('on');
        document.querySelectorAll('#ffd-root .tool-tab').forEach(function(s){s.classList.remove('on');});
        var tab=g('tt-'+t);
        if(tab)tab.classList.add('on');
      },
      ov:function(){
        var act=loans.filter(function(l){return l.status==='active';});
        var empty=!loans.length;
        var dash='<span style="color:var(--text4)">—</span>';
        var tU=loans.reduce(function(s,l){return s+toU(l.amount,l.c);},0);
        var aU=act.reduce(function(s,l){return s+toU(l.amount,l.c);},0);
        var tC=loans.reduce(function(s,l){return s+l.col;},0);
        var aC=act.reduce(function(s,l){return s+l.col;},0);
        var avgR=act.length?act.reduce(function(s,l){return s+l.rate;},0)/act.length:0;
        var colVal=aC*R.BTC;
        var aDue=act.reduce(function(s,l){return s+toU(l.amount,l.c)+intU(l);},0);
        var portLtv=colVal>0?(aDue/colVal*100):0;
        var portLtvColor=portLtv>=95?'#dc2626':portLtv>=79?'#ea580c':portLtv>=73?'#d97706':'#16a34a';
        /* Next due loan */
        var nextDue=act.length?act.slice().sort(function(a,b){return dL(a.start,a.term)-dL(b.start,b.term);})[0]:null;
        /* MC price */
        /* Next MC: per loan find next unbreached threshold, show closest */
        var _mc1p=cfg.ltvWarn!=null?cfg.ltvWarn/100:0.73;
        var _mc2p=cfg.ltvCrit!=null?cfg.ltvCrit/100:0.79;
        var _mc3p=cfg.ltvDanger!=null?cfg.ltvDanger/100:0.86;
        var _liqp=0.95;
        var _mcThr=[{lbl:'MC1',pct:_mc1p},{lbl:'MC2',pct:_mc2p},{lbl:'MC3',pct:_mc3p},{lbl:'Liq.',pct:_liqp}];
        var _mcItems=act.filter(function(l){return l.col>0;}).map(function(l){
          var due=toU(l.amount,l.c)+intU(l);
          var ltv=due/(l.col*R.BTC);
          var next=_mcThr[_mcThr.length-1];
          for(var _ti=0;_ti<_mcThr.length;_ti++){if(ltv<_mcThr[_ti].pct){next=_mcThr[_ti];break;}}
          var price=due/(next.pct*l.col);
          return {lbl:next.lbl,price:price,dist:(R.BTC-price)/R.BTC*100,name:l.name};
        });
        var _mcNearest=_mcItems.length?_mcItems.reduce(function(a,b){return a.dist<b.dist?a:b;}):null;
        var nextMC=_mcNearest?_mcNearest.price:null;
        var nextMClbl=_mcNearest?_mcNearest.lbl:'MC1';
        var nextMCdist=_mcNearest?_mcNearest.dist:null;
        /* New metrics */
        var totalInterestUSD=act.reduce(function(s,l){return s+intU(l);},0);
        var totalFeeUSD=act.reduce(function(s,l){return s+feeU(l);},0);
        var monthlyInterestUSD=act.reduce(function(s,l){return s+toU(l.amount*(l.rate/100)/12,l.c);},0);
        var totalDueUSD=aU+totalInterestUSD;
        var coverage=aDue>0?(colVal/aDue):0;
        var CC=(['EUR','CHF','USD','USDT','USDC','CZK','PLN','BTC']).filter(visC);
        /* Multi-currency interest strings */
        var intCcyGrid=usdGrid(CC,totalInterestUSD);
        /* Per-currency breakdowns for active loans */
        var activeCcys=act.reduce(function(a,l){if(a.indexOf(l.c)<0)a.push(l.c);return a;},[]);
        function ccyBreakdown(fn){
          return activeCcys.map(function(c){
            var v=act.filter(function(l){return l.c===c;}).reduce(function(s,l){return s+fn(l);},0);
            return '<b>'+c+'</b> '+fmt(v,c);
          }).join(' · ');
        }
        function ccyBreakdownGrid(fn){
          return cGrid(activeCcys.map(function(c){
            var v=act.filter(function(l){return l.c===c;}).reduce(function(s,l){return s+fn(l);},0);
            return {c:c,v:v};
          }));
        }
        var dueByCcyGrid=ccyBreakdownGrid(function(l){return l.amount+l.amount*(l.rate/100)*(l.term/12);});
        var costByCcyGrid=ccyBreakdownGrid(function(l){return l.amount*(l.rate/100)*(l.term/12)+(l.feeBtc||0)*(R.BTC/(R[l.c]||1));});
        var colValCcyGrid=usdGrid(CC,colVal);
        /* Per-currency LTV breakdown */
        var ccyLtvParts=activeCcys.map(function(c){
          var ccyLoans=act.filter(function(l){return l.c===c&&l.col>0;});
          if(!ccyLoans.length)return null;
          var ccyDue=ccyLoans.reduce(function(s,l){return s+toU(l.amount,l.c)+intU(l);},0);
          var ccyCol=ccyLoans.reduce(function(s,l){return s+l.col;},0)*R.BTC;
          var ltv=ccyCol>0?(ccyDue/ccyCol*100):0;
          var col=ltv>=95?'var(--err)':ltv>=79?'#ea580c':ltv>=73?'var(--warn)':'var(--ok)';
          return '<b>'+c+'</b> <span style="color:'+col+'">'+ltv.toFixed(1)+'%</span>';
        }).filter(Boolean);
        var ltvSub=empty?'&nbsp;':(portLtv<73?'✓ Sicher':portLtv<79?'⚠ Beobachten':portLtv<86?'⚠ MC2':portLtv<95?'⚠ MC3':'⚠ Kritisch');
        if(ccyLtvParts.length>1)ltvSub+=' &middot; '+ccyLtvParts.join(' &middot; ');
        function grpCard(title,tiles,cols){
          return '<div class="card" style="padding:.75rem;display:flex;flex-direction:column">'+
            '<div style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:var(--text3);padding-bottom:.4rem;border-bottom:1px solid var(--border);margin-bottom:.5rem">'+title+'</div>'+
            '<div class="grp-inner" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(120px,1fr));gap:8px;flex:1;align-content:start">'+tiles+'</div>'+
          '</div>';
        }
        var grpPortfolio=
          '<div class="mc" style="margin:0"><span class="mc-lbl">Aktive Kredite</span><span class="mc-val">'+(empty?dash:act.length)+'</span><span class="mc-sub">'+(empty?'&nbsp;':'von '+loans.length+' gesamt')+'</span></div>'+
          '<div class="mc" style="margin:0"><span class="mc-lbl">Offene Schuld (USD)</span><span class="mc-val">'+(empty?dash:fmt(aDue,'USD'))+'</span><span class="mc-sub" style="font-size:10px;line-height:1.4">'+(empty?'&nbsp;':dueByCcyGrid)+'</span></div>'+
          '<div class="mc" style="margin:0"><span class="mc-lbl">Collateral (aktiv)</span><span class="mc-val">'+(empty?dash:aC.toFixed(8)+' BTC')+'</span><span class="mc-sub" style="font-size:10px;line-height:1.4">'+(empty?'&nbsp;':colValCcyGrid)+'</span></div>';
        /* Nearest liquidation price across all active loans with collateral */
        var liqItems=act.filter(function(l){return l.col>0;}).map(function(l){
          var due=toU(l.amount,l.c)+intU(l);
          var liqPrice=due/(0.95*l.col);
          return {name:l.name,price:liqPrice,dist:(R.BTC-liqPrice)/R.BTC*100};
        });
        var nearestLiq=liqItems.length?liqItems.reduce(function(a,b){return a.dist<b.dist?a:b;}):null;
        var grpRisiko=
          '<div class="mc" style="margin:0"><span class="mc-lbl">Portfolio-LTV</span><span class="mc-val">'+(empty?dash:'<span style="color:'+portLtvColor+'">'+portLtv.toFixed(1)+'%</span>')+'</span><span class="mc-sub" style="font-size:10px;line-height:1.4">'+(empty?'&nbsp;':ltvSub)+'</span></div>'+
          '<div class="mc" style="margin:0"><span class="mc-lbl">Deckungsgrad</span><span class="mc-val">'+(empty?dash:'<span style="color:'+(coverage<1.1?'#dc2626':coverage<1.4?'#d97706':'#16a34a')+'">'+coverage.toFixed(2)+'×</span>')+'</span><span class="mc-sub">'+(empty?'&nbsp;':'Col. / Schulden')+'</span></div>'+
          '<div class="mc" style="margin:0"><span class="mc-lbl">Nächster '+(empty?'MC':nextMClbl)+'</span><span class="mc-val">'+(empty?dash:(nextMC?'<span style="color:'+(nextMCdist<0?'var(--err)':nextMCdist<5?'var(--err)':nextMCdist<15?'#d97706':'inherit')+'">$'+Math.round(nextMC).toLocaleString('de-CH')+'</span>':'–'))+'</span><span class="mc-sub">'+(empty?'&nbsp;':(nextMCdist!==null?nextMCdist.toFixed(1)+'% Abstand':''))+'</span></div>'+
          (nearestLiq?
            '<div class="mc" style="margin:0"><span class="mc-lbl">Nächster Liq.-Preis</span>'+
            '<span class="mc-val"><span style="color:'+(nearestLiq.dist<0?'#dc2626':nearestLiq.dist<5?'#dc2626':nearestLiq.dist<15?'#d97706':'inherit')+'">$'+Math.round(nearestLiq.price).toLocaleString('de-CH')+'</span></span>'+
            '<span class="mc-sub">'+nearestLiq.dist.toFixed(1)+'% Abstand · '+nearestLiq.name+'</span>'+
            '</div>'
          :'');
        var grpKosten=
          '<div class="mc" style="margin:0"><span class="mc-lbl">Ø Zinssatz</span><span class="mc-val">'+(empty?dash:avgR.toFixed(1)+'%')+'</span><span class="mc-sub">'+(empty?'&nbsp;':'p.a. aktiv')+'</span></div>'+
          '<div class="mc" style="margin:0"><span class="mc-lbl">Monatl. Zinslast</span><span class="mc-val" style="font-size:15px;line-height:1.5">'+(empty?dash:usdGrid(CC,monthlyInterestUSD))+'</span><span class="mc-sub">'+(empty?'&nbsp;':'Richtwert p.m.')+'</span></div>'+
          '<div class="mc" style="margin:0"><span class="mc-lbl">Gesamtkosten</span><span class="mc-val" style="font-size:15px;line-height:1.5">'+(empty?dash:usdGrid(CC,totalInterestUSD+totalFeeUSD))+'</span><span class="mc-sub" style="font-size:10px;line-height:1.4">'+(empty?'&nbsp;':costByCcyGrid)+'</span></div>';
        var soonDays=cfg.countdownDays||30;
        var soonLoans=act.filter(function(l){var d=dL(l.start,l.term);return d>=0&&d<=soonDays;}).sort(function(a,b){return dL(a.start,a.term)-dL(b.start,b.term);});
        var soonHtml=soonLoans.length?soonLoans.map(function(l){
          var dl=dL(l.start,l.term);
          var col=dl<=7?'var(--err)':dl<=14?'var(--warn)':'var(--text)';
          return '<div class="mc" style="margin:0">'+
            '<span class="mc-lbl">'+l.name+'</span>'+
            '<span class="mc-val" style="color:'+col+'">'+dl+' Tage</span>'+
            '<span class="mc-sub">F\u00e4llig: '+fmt(frU(dueU(l),l.c),l.c)+'</span>'+
            '<span class="mc-sub">'+aM(l.start,l.term).toLocaleDateString('de-CH',{day:'2-digit',month:'short',year:'numeric'})+'</span>'+
          '</div>';
        }).join(''):'<div class="mc" style="margin:0"><span class="mc-lbl">Nächste Fälligkeiten</span><span class="mc-val">—</span><span class="mc-sub">Keine in den nächsten '+soonDays+' Tagen</span></div>';
        var grpZeit=soonHtml;
        /* ── Kommende Fälligkeiten (Kapital + Zinsen, ohne Gebühren) ── */
        var dueWindows=[{d:7,lbl:'7 Tage'},{d:14,lbl:'14 Tage'},{d:30,lbl:'30 Tage'},{d:60,lbl:'60 Tage'},{d:90,lbl:'90 Tage'},{d:180,lbl:'180 Tage'},{d:365,lbl:'1 Jahr'},{d:730,lbl:'2 Jahre'}];
        var grpDue=dueWindows.map(function(w){
          var inWindow=act.filter(function(l){var dl=dL(l.start,l.term);return dl>=0&&dl<=w.d;});
          var totalUSD=inWindow.reduce(function(s,l){return s+toU(l.amount,l.c)+intU(l);},0);
          var count=inWindow.length;
          var urgent=inWindow.some(function(l){return dL(l.start,l.term)<=7;});
          var soon=!urgent&&inWindow.some(function(l){return dL(l.start,l.term)<=14;});
          var accentClr=urgent?'var(--err)':soon?'var(--warn)':'var(--text)';
          var subParts=CC.filter(function(c){return c!=='USD'&&c!=='BTC'&&c!=='SAT';}).map(function(c){
            return count>0?('<b>'+c+'</b> '+fmt(frU(totalUSD,c),c)):null;
          }).filter(Boolean);
          var subHtml=count===0?'<span style="color:var(--text4)">Keine Fälligkeit</span>':
            (subParts.length?subParts.join(' · '):(count===1?'1 Kredit':count+' Kredite'));
          var valHtml=count===0
            ?'<span style="color:var(--text4)">—</span>'
            :'<span style="color:'+accentClr+'">'+fmt(frU(totalUSD,'USD'),'USD')+'</span>';
          return '<div class="mc" style="margin:0">'+
            '<span class="mc-lbl">'+w.lbl+'</span>'+
            '<span class="mc-val" style="font-size:15px;line-height:1.5">'+valHtml+'</span>'+
            '<span class="mc-sub" style="font-size:10px;line-height:1.4">'+subHtml+'</span>'+
          '</div>';
        }).join('');
        var dueTilesHtml=
          '<div class="card" style="padding:.75rem;display:flex;flex-direction:column;grid-column:span 2">'+
            '<div style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:var(--text3);padding-bottom:.4rem;border-bottom:1px solid var(--border);margin-bottom:.6rem">Kommende Fälligkeiten — Kumulierte Schulden</div>'+
            '<div style="display:grid;grid-template-columns:repeat(8,1fr);gap:8px">'+grpDue+'</div>'+
          '</div>';
        g('metrics').innerHTML=
          '<div class="ov-grp-grid">'+
            grpCard('Portfolio',grpPortfolio)+
            grpCard('Kosten',grpKosten)+
            grpCard('Zeit',grpZeit)+
            grpCard('Risiko',grpRisiko)+
            dueTilesHtml+
          '</div>';
        var CC=['EUR','CHF','USD','USDT','USDC','CZK','PLN','BTC'].filter(visC);
        g('ov-multi').innerHTML=
          '<p class="note2" style="margin-bottom:.5rem">Aktive Schulden:</p>'+ccyG(CC,aDue)+
          '<p class="note2" style="margin:.75rem 0 .5rem">Gesamtschulden:</p>'+ccyG(CC,tU);
        var inp=g('ltv-thresh-input');if(inp&&inp.value==='')inp.value=ltvThresh;
        var filtered_ltv=act.filter(function(l){if(!l.col)return false;var due=dueU(l);return(due/(l.col*R.BTC))*100>=ltvThresh;});
        g('ov-ltv').innerHTML=filtered_ltv.length?filtered_ltv.map(function(l){
          var cU=l.col*R.BTC,lU=toU(l.amount,l.c),due3=dueU(l),ltv=(due3/cU)*100,w=Math.min(ltv,100),dl=dL(l.start,l.term);
          var interest=l.amount*(l.rate/100)*(l.term/12);
          var end=aM(l.start,l.term).toLocaleDateString('de-CH');
          var started=new Date(l.start),now2=new Date(),totalMs=aM(l.start,l.term)-started;
          var pct=totalMs>0?Math.min(100,Math.max(0,((now2-started)/totalMs*100))).toFixed(1):100;
          var mc1P=due3/(0.73*l.col);
          var beDist=l.col>0?((R.BTC-mc1P)/R.BTC*100).toFixed(1):null;
          var beHtml=l.col>0?'<div style="font-size:11px;color:var(--text4);margin-top:.4rem">MC1 bei $'+Math.round(mc1P).toLocaleString('de-CH')+' ('+(beDist>0?'−'+beDist:'⚠ überschritten')+'% vom aktuellen Preis)</div>':'';
          return '<div class="card">'+
            '<div class="lh"><span class="lid">'+l.name+' <span class="lid-sub">'+l.id+'</span></span><div class="fx" style="gap:4px"><span class="badge ba">Aktiv</span>'+(l.chainId?'<span class="badge" style="background:var(--accent-bg);color:var(--accent);border:1px solid var(--accent);cursor:pointer" onclick="goRo()">🔗 Roll-Over</span>':'')+' </div></div>'+
            /* ② Kernzahlen 3-spaltig */
            '<div class="lmeta" style="grid-template-columns:1fr 1fr 1fr">'+
              '<div><span class="ll">Betrag</span><span class="lv">'+fmt(l.amount,l.c)+'</span></div>'+
              '<div><span class="ll">F\u00e4lliger Betrag</span><span class="lv">'+fmt(l.amount+interest,l.c)+'</span></div>'+
              '<div><span class="ll">Zins p.a.</span><span class="lv">'+l.rate+'%</span></div>'+
            '</div>'+
            /* ③ Zeitinfo 2-spaltig */
            '<div class="lmeta" style="grid-template-columns:1fr 1fr;margin-top:.4rem">'+
              '<div><span class="ll">Start</span><span class="lv">'+new Date(l.start).toLocaleDateString('de-CH')+'</span></div>'+
              '<div><span class="ll">F\u00e4llig</span><span class="lv">'+end+'</span></div>'+
              '<div><span class="ll">Laufzeit</span><span class="lv">'+l.term+' Monate</span></div>'+
            '</div>'+
            /* ④ Collateral & Risiko 2-spaltig */
            '<div class="lmeta" style="grid-template-columns:1fr 1fr;margin-top:.4rem">'+
              '<div><span class="ll">Collateral</span><span class="lv">'+l.col.toFixed(8)+' BTC</span></div>'+
              (l.status==='active'&&l.col>0?(function(){var due=dueU(l);var liqUSD=due/(0.95*l.col);var near=R.BTC<liqUSD*1.1;return '<div><span class="ll">Liquidationspreis</span><span class="lv" style="color:'+(R.BTC<=liqUSD?'#dc2626':near?'#d97706':'#16a34a')+'">'+fmt(frU(liqUSD,l.c),l.c)+''+(R.BTC<=liqUSD?' ⚠ Liquidiert':near?' ⚠ Nahe':'')+'</span></div>';})():'')+
              '<div><span class="ll">Geb\u00fchr</span><span class="lv">'+(l.feeBtc?l.feeBtc+' BTC (\u2248 $'+feeU(l).toLocaleString('de-CH',{maximumFractionDigits:0})+')':'–')+'</span></div>'+
            '</div>'+
            /* ⑤ Fortschrittsbalken */
            '<div class="prog-row" style="margin-top:.6rem"><span>Laufzeit vergangen</span><span>'+pct+'% '+(l.status==='active'&&dl>0?'<span style="color:var(--text4)">· noch '+dl+' Tage</span>':l.status==='active'?'<span style="color:var(--err)">· F\u00e4llig!</span>':'')+'</span></div>'+
            '<div class="prog-bg"><div class="prog-fill" style="width:'+pct+'%"></div></div>'+
            /* ⑥ LTV-Balken */
            (l.status==='active'&&l.col>0?(function(){
              var ltv=((lU+toU(interest,l.c))/(l.col*R.BTC))*100;
              var ltvW=Math.min(ltv,100);
              return '<div class="prog-row" style="margin-top:.4rem"><span>LTV</span><span style="color:'+lc(ltv)+';font-weight:600">'+ltv.toFixed(1)+'%</span></div>'+
                '<div class="prog-bg" style="background:var(--bg3);position:relative">'+
                  '<div class="prog-fill" style="width:'+ltvW+'%;background:'+lc(ltv)+'"></div>'+
                  '<div style="position:absolute;left:60%;top:-3px;width:1px;height:10px;background:#d97706;opacity:.5"></div>'+
                  '<div style="position:absolute;left:73%;top:-3px;width:1px;height:10px;background:#ea580c;opacity:.6"></div>'+
                  '<div style="position:absolute;left:95%;top:-3px;width:1px;height:10px;background:#dc2626"></div>'+
                '</div>'+
                '<div style="display:flex;justify-content:space-between;font-size:10px;color:var(--border2);margin-top:2px">'+
                  '<span style="padding-left:60%">60</span>'+
                  '<span style="padding-left:15%">75</span>'+
                  '<span>95</span>'+
                '</div>';
            })():'')+
            /* ⑦ Währungsumrechnung */
            '<p class="note" style="margin:.5rem 0">'+['EUR','CHF','USD','USDT','BTC'].filter(function(c){return c!==l.c&&visC(c);}).map(function(c){return '<b>'+c+'</b> '+fmt(frU(lU,c),c);}).join(' \u00b7 ')+'</p>'+
            /* ⑧ Break-even */
            beHtml+
            (l.note?'<div style="margin-top:.6rem;padding:.45rem .65rem;border-radius:8px;background:var(--bg2);border:1px solid var(--border);font-size:12px;color:var(--text3)"><span style="font-weight:600;color:var(--text2)">&#128172; </span>'+l.note.replace(/</g,'&lt;')+'</div>':'')+
            '</div>';
        }).join(''):'<p class="note2">Keine Kredite über dem LTV-Schwellenwert.</p>';
        d.renderNextAction();
      },
      loansTable:function(sorted){
        var el=g('loans-list');
        el.style.display='block';
        if(!sorted.length){el.innerHTML='<div class="empty">'+(lFilter==='active'?'Keine aktiven Kredite.':lFilter==='closed'?'Keine abgeschlossenen Kredite.':'Noch keine Kredite.')+'</div>';return;}
        el.innerHTML='<div class="ovx"><table class="loans-table">'+
          '<thead><tr>'+
            '<th onclick="d.sortBy(\'start\',this)" data-key="start">Bezeichnung</th>'+
            '<th>Status</th>'+
            '<th onclick="d.sortBy(\'amount\',this)" data-key="amount">Betrag</th>'+
            '<th onclick="d.sortBy(\'rate\',this)" data-key="rate">Zins</th>'+
            '<th>Geb&#252;hr</th>'+
            '<th onclick="d.sortBy(\'term\',this)" data-key="term">Laufzeit</th>'+
            '<th onclick="d.sortBy(\'dl\',this)" data-key="dl">F&#228;lligkeit</th>'+
            '<th onclick="d.sortBy(\'interest\',this)" data-key="interest">Zinsen</th>'+
            '<th onclick="d.sortBy(\'due\',this)" data-key="due">F&#228;lliger Betrag</th>'+
            '<th onclick="d.sortBy(\'col\',this)" data-key="col">Collateral</th>'+
            '<th onclick="d.sortBy(\'ltv\',this)" data-key="ltv">LTV</th>'+
            '<th onclick="d.sortBy(\'liq\',this)" data-key="liq">Liquidation (CCY)</th>'+
            '<th onclick="d.sortBy(\'liq\',this)" data-key="liq">Liquidation (USD)</th>'+
            '<th></th>'+
          '</tr></thead>'+
          '<tbody>'+sorted.map(function(l){
            var i=l._i;
            var dl=dL(l.start,l.term),end=aM(l.start,l.term).toLocaleDateString('de-CH');
            var lU=toU(l.amount,l.c);
            var interest=l.amount*(l.rate/100)*(l.term/12);
            var ltv=l.col>0?(dueU(l)/(l.col*R.BTC))*100:null;
            var liqUSDval=0,liqCcyStr='–',liqUSDstr='–';
            var interestStr=fmt(interest,l.c);
            var feeStr=l.feeBtc>0?l.feeBtc+' BTC':'–';
            var dueAmount=l.amount+interest+(l.feeBtc||0)*(R.BTC/(R[l.c]||1));
            var dueStr=fmt(dueAmount,l.c);
            if(l.status==='active'&&l.col>0){var due=dueU(l);liqUSDval=due/(0.95*l.col);var near=R.BTC<liqUSDval*1.1;var col='color:'+(R.BTC<=liqUSDval?'#dc2626':near?'#d97706':'#16a34a');liqCcyStr='<span style="'+col+'">'+fmt(frU(liqUSDval,l.c),l.c)+'</span>';liqUSDstr='<span style="'+col+'">$'+liqUSDval.toLocaleString('de-CH',{maximumFractionDigits:0})+'</span>';}
            var dlStr=l.status==='active'?(dl>0?'<span style="color:'+(dl<30?'#dc2626':dl<60?'#d97706':'var(--text2)')+'">'+dl+' Tage</span>':'<span style="color:#dc2626">F&#228;llig!</span>'):'<span style="color:#9ca3af">&#10003;</span>';
            return '<tr>'+
              '<td><div class="tbl-name">'+l.name+(l.chainId?' <span class="badge" title="Roll-Over" style="background:var(--accent-bg);color:var(--accent);border:1px solid var(--accent);cursor:pointer;font-size:11px;padding:1px 4px;vertical-align:middle" onclick="goRo()">🔗</span>':'')+'</div><div class="tbl-id">'+l.id+'</div></td>'+
              '<td><span class="badge '+(l.status==='active'?'ba':'bc')+'">'+(l.status==='active'?'Aktiv':'Abgeschlossen')+'</span></td>'+
              '<td class="amt">'+fmt(l.amount,l.c)+'</td>'+
              '<td>'+l.rate+'%</td>'+
              '<td class="amt">'+(l.feeBtc?feeStr:'–')+'</td>'+
              '<td>'+l.term+' Mo</td>'+
              '<td>'+dlStr+'</td>'+
              '<td class="amt">'+interestStr+'</td>'+
              '<td class="amt">'+dueStr+'</td>'+
              '<td class="amt">'+l.col.toFixed(8)+' BTC</td>'+
              '<td class="amt">'+(ltv!==null?'<span style="color:'+lc(ltv)+';font-weight:600">'+ltv.toFixed(1)+'%</span><div class="tbl-ltv-bar"><div class="tbl-ltv-fill" style="width:'+Math.min(ltv,100)+'%;background:'+lc(ltv)+'"></div></div>':'–')+'</td>'+
              '<td class="amt">'+liqCcyStr+'</td>'+
              '<td class="amt">'+liqUSDstr+'</td>'+
              '<td><div class="tbl-actions">'+
                '<button class="sm" style="padding:2px 8px;font-size:12px" onclick="d.openEdit('+i+')">&#9998;</button>'+
                '<button class="sm" style="padding:2px 8px;font-size:12px" onclick="d.dupLoan('+i+')" title="Duplizieren">&#10064;</button>'+
                '<button class="del" onclick="d.openDel('+i+')">&#10005;</button>'+
              '</div></td>'+
            '</tr>';
          }).join('')+
          '</tbody></table></div>';
        document.querySelectorAll('#ffd-root .loans-table th[data-key]').forEach(function(th){
          var isActive=th.dataset.key===lSort.key;
          th.style.color=isActive?'#F97316':'';
          /* Store base label once */
          if(!th.dataset.label)th.dataset.label=th.textContent.replace(/ [↑↓]$/,'');
          th.textContent=th.dataset.label+(isActive?(lSort.dir===1?' ↑':' ↓'):'');
        });
      },
      loans:function(){
        var el=g('loans-list');
        if(!el)return;
        /* Base sets for cross-dependent counts */
        var byCcy=lCcyFilter&&lCcyFilter!=='all'?loans.filter(function(l){return l.c===lCcyFilter;}):loans;
        var byStatus=lFilter==='active'?loans.filter(function(l){return l.status==='active';}):lFilter==='closed'?loans.filter(function(l){return l.status==='closed';}):loans;
        /* Status filter counts (respect active ccy filter) */
        var ftAll=g('ft-all'),ftAct=g('ft-active'),ftClo=g('ft-closed');
        if(ftAll)ftAll.textContent='Alle ('+byCcy.length+')';
        if(ftAct)ftAct.textContent='Aktiv ('+byCcy.filter(function(l){return l.status==='active';}).length+')';
        if(ftClo)ftClo.textContent='Abgeschlossen ('+byCcy.filter(function(l){return l.status==='closed';}).length+')';
        /* Currency filter counts (respect active status filter) */
        var ccyBar=g('ccy-filter-bar');
        if(ccyBar){
          var usedCcys=loans.reduce(function(acc,l){if(acc.indexOf(l.c)<0)acc.push(l.c);return acc;},[]);
          if(usedCcys.length>1){
            ccyBar.style.display='flex';
            var currentCcyFilter=lCcyFilter||'all';
            ccyBar.innerHTML='<button class="filter-tab'+(currentCcyFilter==='all'?' on':'')+'" onclick="d.filterCcy(\'all\',this)">Alle ('+byStatus.length+')</button>'+
              usedCcys.map(function(c){var n=byStatus.filter(function(l){return l.c===c;}).length;return '<button class="filter-tab'+(currentCcyFilter===c?' on':'')+'" onclick="d.filterCcy(\''+c+'\',this)">'+c+' ('+n+')</button>';}).join('');
          } else {
            ccyBar.style.display='none';
          }
        }
        var sorted=loans.slice().map(function(l,i){return Object.assign({},l,{_i:i});});
        /* Filter */
        if(lFilter==='active')sorted=sorted.filter(function(l){return l.status==='active';});
        if(lFilter==='closed')sorted=sorted.filter(function(l){return l.status==='closed';});
        if(lCcyFilter&&lCcyFilter!=='all')sorted=sorted.filter(function(l){return l.c===lCcyFilter;});
        /* Sort */
        sorted.sort(function(a,b){
          var v=0;
          if(lSort.key==='start')v=new Date(a.start)-new Date(b.start);
          else if(lSort.key==='amount')v=toU(a.amount,a.c)-toU(b.amount,b.c);
          else if(lSort.key==='rate')v=a.rate-b.rate;
          else if(lSort.key==='term')v=a.term-b.term;
          else if(lSort.key==='dl')v=dL(a.start,a.term)-dL(b.start,b.term);
          else if(lSort.key==='ltv'){var la=a.col>0?(dueU(a)/(a.col*R.BTC)):0,lb2=b.col>0?(dueU(b)/(b.col*R.BTC)):0;v=la-lb2;}
          else if(lSort.key==='status')v=a.status.localeCompare(b.status);
          else if(lSort.key==='interest')v=intU(a)-intU(b);
          else if(lSort.key==='due')v=dueU(a)-dueU(b);
          else if(lSort.key==='col')v=a.col-b.col;
          else if(lSort.key==='liq'){var la2=a.col>0?dueU(a)/(0.95*a.col):0,lb3=b.col>0?dueU(b)/(0.95*b.col):0;v=la2-lb3;}
          else if(lSort.key==='fee')v=feeU(a)-feeU(b);
          return v*lSort.dir;
        });
        if(lView==='list'){d.loansTable(sorted);return;}
        if(!sorted.length){el.style.display='grid';el.innerHTML='<div class="empty">'+(lFilter==='active'?'Keine aktiven Kredite.':lFilter==='closed'?'Keine abgeschlossenen Kredite.':'Noch keine Kredite.')+'</div>';return;}
        el.style.display='grid';
        el.innerHTML=sorted.map(function(l){
          var i=l._i;
          var dl=dL(l.start,l.term),end=aM(l.start,l.term).toLocaleDateString('de-CH');
          var pct=l.status==='closed'?100:Math.min(100,Math.round((new Date()-new Date(l.start))/(864e5*l.term*30)*100));
          var interest=l.amount*(l.rate/100)*(l.term/12),lU=toU(l.amount,l.c);
          /* Break-even */
          var btcAtStart=l.btcStart||null;
          var bep=btcAtStart?btcAtStart*(dueU(l)/lU):null;
          var beHtml='';
          if(cfg.hideBreakEven){
            beHtml='';
          } else if(bep!==null){
            var won=R.BTC>=bep;
            beHtml='<div class="amt" style="display:flex;align-items:center;gap:8px;margin-top:.6rem;padding:.5rem .65rem;border-radius:8px;background:'+(won?'var(--ok-bg)':'var(--warn-bg)')+';border:1px solid '+(won?'var(--ok-border)':'var(--warn-border)')+'">'+
              '<span style="font-size:16px">'+(won?'✅':'⏳')+'</span>'+
              '<div>'+
                '<div style="font-size:12px;font-weight:600;color:'+(won?'var(--ok)':'var(--warn)')+'">'+(won?'Break-even erreicht — Kredit hat sich gelohnt':'Break-even noch nicht erreicht')+'</div>'+
                '<div style="font-size:11px;color:var(--text3)">Break-even: <b>$'+bep.toLocaleString('de-CH',{maximumFractionDigits:0})+'</b> · Aktuell: <b>$'+R.BTC.toLocaleString('de-CH',{maximumFractionDigits:0})+'</b>'+(won?' · <span style="color:var(--ok)">▲ $'+(R.BTC-bep).toLocaleString('de-CH',{maximumFractionDigits:0})+' über Break-even</span>':' · <span style="color:var(--warn)">noch $'+(bep-R.BTC).toLocaleString('de-CH',{maximumFractionDigits:0})+' bis Break-even</span>')+'</div>'+
              '</div>'+
            '</div>';
          } else {
            var bsWid='bsw-'+l.id;
            beHtml='<div id="'+bsWid+'" style="margin-top:.6rem;padding:.5rem .65rem;border-radius:8px;background:var(--bg2);border:1px solid var(--border)">'+
              '<div style="display:flex;align-items:center;gap:8px;flex-wrap: wrap;">'+
                '<span style="font-size:14px">📊</span>'+
                '<span style="font-size:11px;color:var(--text3)">Kein BTC-Startpreis hinterlegt</span>'+
                '<button onclick="d.loadHistBtc('+i+',\''+l.id+'\',\''+l.start+'\')" style="font-size:11px;color:var(--accent);background:none;border:1px solid var(--accent);border-radius:4px;cursor:pointer;padding:1px 7px">Historischen Preis laden</button>'+
              '</div>'+
              '<div id="'+bsWid+'-suggest" style="display:none;margin-top:.5rem"></div>'+
            '</div>';
            setTimeout(function(li,ls,wid){return function(){d.loadHistBtc_auto(li,ls,wid);};}(i,l.start,bsWid),0);
          }
          return '<div class="card">'+
            /* ① Kopfzeile */
            '<div class="lh"><span class="lid">'+l.name+' <span class="lid-sub">'+l.id+'</span></span>'+
            '<div class="fx"><span class="badge '+(l.status==='active'?'ba':'bc')+'">'+(l.status==='active'?'Aktiv':'Abgeschlossen')+'</span>'+(l.chainId?'<span class="badge" style="background:var(--accent-bg);color:var(--accent);border:1px solid var(--accent);cursor:pointer" onclick="goRo()">🔗 Roll-Over</span>':'')+
            '<button class="sm" style="padding:2px 8px;font-size:12px" onclick="d.openEdit('+i+')">&#9998;</button>'+
            '<button class="sm" style="padding:2px 8px;font-size:12px" onclick="d.dupLoan('+i+')" title="Duplizieren">&#10064;</button>'+
            '<button class="del" onclick="d.openDel('+i+')">&#10005;</button></div></div>'+
            /* ② Kernzahlen 3-spaltig */
            '<div class="lmeta" style="grid-template-columns:1fr 1fr 1fr">'+
              '<div><span class="ll">Betrag</span><span class="lv">'+fmt(l.amount,l.c)+'</span></div>'+
              '<div><span class="ll">Fälliger Betrag</span><span class="lv">'+fmt(l.amount+interest,l.c)+'</span></div>'+
              '<div><span class="ll">Zins p.a.</span><span class="lv">'+l.rate+'%</span></div>'+
            '</div>'+
            /* ③ Zeitinfo 2-spaltig */
            '<div class="lmeta" style="grid-template-columns:1fr 1fr;margin-top:.4rem">'+
              '<div><span class="ll">Start</span><span class="lv">'+new Date(l.start).toLocaleDateString('de-CH')+'</span></div>'+
              '<div><span class="ll">Fällig</span><span class="lv">'+end+'</span></div>'+
              '<div><span class="ll">Laufzeit</span><span class="lv">'+l.term+' Monate</span></div>'+
            '</div>'+
            /* ④ Collateral & Risiko 2-spaltig */
            '<div class="lmeta" style="grid-template-columns:1fr 1fr;margin-top:.4rem">'+
              '<div><span class="ll">Collateral</span><span class="lv">'+l.col.toFixed(8)+' BTC</span></div>'+
              (l.status==='active'&&l.col>0?(function(){var due=dueU(l);var liqUSD=due/(0.95*l.col);var near=R.BTC<liqUSD*1.1;return '<div><span class="ll">Liquidationspreis</span><span class="lv" style="color:'+(R.BTC<=liqUSD?'#dc2626':near?'#d97706':'#16a34a')+'">'+fmt(frU(liqUSD,l.c),l.c)+''+(R.BTC<=liqUSD?' ⚠ Liquidiert':near?' ⚠ Nahe':'')+'</span></div>';})():'')+
              '<div><span class="ll">Gebühr</span><span class="lv">'+(l.feeBtc?l.feeBtc+' BTC (≈ $'+feeU(l).toLocaleString('de-CH',{maximumFractionDigits:0})+')':'–')+'</span></div>'+
            '</div>'+
            /* ⑤ Fortschrittsbalken */
            '<div class="prog-row" style="margin-top:.6rem"><span>Laufzeit vergangen</span><span>'+pct+'% '+(l.status==='active'&&dl>0?'<span style="color:var(--text4)">· noch '+dl+' Tage</span>':l.status==='active'?'<span style="color:var(--err)">· Fällig!</span>':'')+'</span></div>'+
            '<div class="prog-bg"><div class="prog-fill" style="width:'+pct+'%"></div></div>'+
            /* ⑥ LTV-Balken */
            (l.status==='active'&&l.col>0?(function(){
              var ltv=((lU+toU(interest,l.c))/(l.col*R.BTC))*100;
              var ltvW=Math.min(ltv,100);
              return '<div class="prog-row" style="margin-top:.4rem"><span>LTV</span><span style="color:'+lc(ltv)+';font-weight:600">'+ltv.toFixed(1)+'%</span></div>'+
                '<div class="prog-bg" style="background:var(--bg3);position:relative">'+
                  '<div class="prog-fill" style="width:'+ltvW+'%;background:'+lc(ltv)+'"></div>'+
                  '<div style="position:absolute;left:60%;top:-3px;width:1px;height:10px;background:#d97706;opacity:.5"></div>'+
                  '<div style="position:absolute;left:73%;top:-3px;width:1px;height:10px;background:#ea580c;opacity:.6"></div>'+
                  '<div style="position:absolute;left:95%;top:-3px;width:1px;height:10px;background:#dc2626"></div>'+
                '</div>'+
                '<div style="display:flex;justify-content:space-between;font-size:10px;color:var(--text4);margin-top:2px">'+
                  '<span style="padding-left:60%">60</span>'+
                  '<span style="padding-left:15%">75</span>'+
                  '<span>95</span>'+
                '</div>';
            })():'')+
            /* ⑦ Währungsumrechnung */
            '<p class="note" style="margin:.5rem 0">'+['EUR','CHF','USD','USDT','BTC'].filter(function(c){return c!==l.c&&visC(c);}).map(function(c){return '<b>'+c+'</b> '+fmt(frU(lU,c),c);}).join(' · ')+'</p>'+
            /* ⑧ Break-even */
            beHtml+
            (l.note?'<div style="margin-top:.6rem;padding:.45rem .65rem;border-radius:8px;background:var(--bg2);border:1px solid var(--border);font-size:12px;color:var(--text3)"><span style="font-weight:600;color:var(--text2)">&#128172; </span>'+l.note.replace(/</g,'&lt;')+'</div>':'')+
            '</div>';
        }).join('');
      },
      setView:function(v,el){
        lView=v;
        document.querySelectorAll('#ffd-root .view-btn').forEach(function(b){b.classList.remove('on');});
        var gb=g('view-grid-btn'),lb=g('view-list-btn');
        if(v==='grid'&&gb)gb.classList.add('on');
        if(v==='list'&&lb)lb.classList.add('on');
        d.loans();
      },
      sortBy:function(key,el){
        if(lSort.key===key){lSort.dir*=-1;}else{lSort.key=key;lSort.dir=1;}
        var arrow=lSort.dir===1?' ↑':' ↓';
        /* Sort buttons (grid view) */
        document.querySelectorAll('#ffd-root .sort-btn').forEach(function(b){
          b.classList.remove('on');
          /* Restore label without arrow */
          b.textContent=b.dataset.label||b.textContent.replace(/ [↑↓]$/,'');
          if(!b.dataset.label)b.dataset.label=b.textContent;
        });
        if(el){
          el.classList.add('on');
          if(!el.dataset.label)el.dataset.label=el.textContent.replace(/ [↑↓]$/,'');
          el.textContent=el.dataset.label+arrow;
        }
        d.loans();
      },
      filterLoans:function(f,el){
        lFilter=f;
        document.querySelectorAll('#ffd-root .filter-tabs .filter-tab').forEach(function(b){b.classList.remove('on');});
        if(el)el.classList.add('on');
        d.loans();
      },
      filterCcy:function(c,el){
        lCcyFilter=c;
        document.querySelectorAll('#ccy-filter-bar .filter-tab').forEach(function(b){b.classList.remove('on');});
        if(el)el.classList.add('on');
        d.loans();
      },
      togAdd:function(){
        var p=g('add-panel');
        var isOpen=p.style.display==='none'||!p.style.display;
        p.style.display=isOpen?'block':'none';
        if(isOpen){
          /* Pre-select default currency */
          var fc=g('fc');if(fc){var dc=cfg.defaultCcy||'EUR';for(var i=0;i<fc.options.length;i++){if(fc.options[i].value===dc){fc.selectedIndex=i;break;}}}
          var fid=g('fid');if(fid)fid.value='';
          d.populateChainSelect('fchain',null,null);
        }
      },
      addLoan:function(){
        var customId=(g('fid').value||'').trim();
        var chainSel=g('fchain').value;
        var chainId=chainSel==='__new__'?uid():chainSel||null;
        loans.push({id:customId||uid(),name:g('fn').value||'Neuer Kredit',
          amount:parseFloat(g('fa').value)||0,c:g('fc').value,rate:parseFloat(g('fr').value)||0,
          feeBtc:parseFloat(g('ffee').value)||0,
          term:parseInt(g('ft').value)||12,start:g('fd').value||new Date().toISOString().split('T')[0],
          col:parseFloat(g('fb').value)||0,status:g('fs').value,
          btcStart:parseFloat(g('fbp').value)||null,
          chainId:chainId||undefined,
          note:g('fnote').value||''});
        d.togAdd();syncStatus();save();d.loans();d.ov();d.extPopulate();d.checkAlarms();
      },
      openReset:function(mode){
        var titles={loans:'Alle Kredite l\u00f6schen',settings:'Einstellungen zur\u00fccksetzen',all:'Alles zur\u00fccksetzen'};
        var descs={
          loans:'Alle '+loans.length+' hinterlegten Kredite werden unwiderruflich gel\u00f6scht. Einstellungen bleiben erhalten.',
          settings:'Alle Einstellungen (W\u00e4hrungen, LTV-Schwellen, Darstellung) werden auf die Standardwerte zur\u00fcckgesetzt. Kredite bleiben erhalten.',
          all:'Alle '+loans.length+' Kredite werden gel\u00f6scht und alle Einstellungen auf die Standardwerte zur\u00fcckgesetzt.'
        };
        g('reset-modal-title').textContent=titles[mode]||'Zur\u00fccksetzen';
        g('reset-modal-desc').textContent=descs[mode]||'';
        g('reset-modal-bg').dataset.mode=mode;
        g('reset-modal-bg').classList.add('open');
      },
      closeReset:function(){g('reset-modal-bg').classList.remove('open');},
      confirmReset:function(){
        var mode=g('reset-modal-bg').dataset.mode;
        var defaultCfg={ccys:['EUR','CHF','USD','USDT','USDC'],defaultTab:'ov',defaultView:'grid',defaultCcy:'EUR',ltvWarn:73,ltvCrit:79,ltvDanger:86,ltvDisplay:73,countdownDays:30,hideAmounts:false,navOrder:null};
        if(mode==='loans'||mode==='all'){
          loans.length=0;
          save();
        }
        if(mode==='settings'||mode==='all'){
          Object.assign(cfg,defaultCfg);
          saveSettings(cfg);
          ltvThresh=cfg.ltvDisplay;
          lView=cfg.defaultView;
          /* Re-render settings UI */
          d.renderCsw();
          var tab=document.getElementById('se-default-tab');if(tab)tab.value=cfg.defaultTab;
          var view=document.getElementById('se-default-view');if(view)view.value=cfg.defaultView;
          var ccy=document.getElementById('se-default-ccy');if(ccy)ccy.value=cfg.defaultCcy;
          var warn=document.getElementById('se-ltv-warn');if(warn)warn.value=cfg.ltvWarn;
          var crit=document.getElementById('se-ltv-crit');if(crit)crit.value=cfg.ltvCrit;
          var danger=document.getElementById('se-ltv-danger');if(danger)danger.value=cfg.ltvDanger;
          var disp=document.getElementById('se-ltv-display');if(disp)disp.value=cfg.ltvDisplay;
          var cd=document.getElementById('se-countdown');if(cd)cd.value=cfg.countdownDays;
        }
        d.closeReset();
        syncStatus();d.loans();d.ov();d.checkAlarms();d.extPopulate();d.vorInit();d.plInit();
      },
      openDel:function(i){
        var l=loans[i];
        g('del-modal-name').textContent=l.name+' ('+fmt(l.amount,l.c)+', '+l.rate+'% p.a.)';
        g('del-modal-bg').dataset.idx=i;
        g('del-modal-bg').classList.add('open');
      },
      closeDel:function(){g('del-modal-bg').classList.remove('open');},
      confirmDel:function(){
        var i=parseInt(g('del-modal-bg').dataset.idx);
        loans.splice(i,1);
        save();
        d.closeDel();
        d.loans();d.ov();d.extPopulate();d.checkAlarms();
      },
      openEdit:function(i){
        var l=loans[i];
        g('ef-n').value=l.name;
        g('ef-id').value=l.id||'';
        g('ef-a').value=l.amount;
        g('ef-r').value=l.rate;
        g('ef-fee').value=l.feeBtc||0;
        g('ef-b').value=l.col;
        g('ef-d').value=l.start;
        ['ef-t','ef-s','ef-c'].forEach(function(id,_){});
        var ts=g('ef-t');for(var o=0;o<ts.options.length;o++){if(parseInt(ts.options[o].value)===l.term){ts.selectedIndex=o;break;}}
        var ss=g('ef-s');for(var o=0;o<ss.options.length;o++){if(ss.options[o].value===l.status){ss.selectedIndex=o;break;}}
        var cs=g('ef-c');for(var o=0;o<cs.options.length;o++){if(cs.options[o].value===l.c){cs.selectedIndex=o;break;}}
        g('ef-bp').value=l.btcStart||'';
        /* Historischen Kurs vorschlagen falls btcStart fehlt */
        if(!l.btcStart&&l.start){d.autoFillBtcStart('ef-d','ef-bp','ef-bp-hint');}
        else{var h=g('ef-bp-hint');if(h)h.style.display='none';}
        g('ef-note').value=l.note||'';
        /* populate chain dropdown */
        d.populateChainSelect('ef-chain',i,l.chainId);
        g('edit-modal-bg').dataset.idx=i;
        g('edit-modal-bg').classList.add('open');
      },
      closeEdit:function(){g('edit-modal-bg').classList.remove('open');},
      saveEdit:function(){
        var i=parseInt(g('edit-modal-bg').dataset.idx);
        var l=loans[i];
        var newId=(g('ef-id').value||'').trim();if(newId&&newId!==l.id){l.id=newId;}
        l.name=g('ef-n').value||l.name;
        l.amount=parseFloat(g('ef-a').value)||l.amount;
        l.rate=parseFloat(g('ef-r').value)||l.rate;
        l.feeBtc=parseFloat(g('ef-fee').value)||0;
        l.col=parseFloat(g('ef-b').value)||l.col;
        l.start=g('ef-d').value||l.start;
        l.term=parseInt(g('ef-t').value)||l.term;
        l.status=g('ef-s').value;
        l.c=g('ef-c').value;
        l.btcStart=parseFloat(g('ef-bp').value)||null;
        l.note=g('ef-note').value||'';
        var chainSel=g('ef-chain').value;
        if(chainSel==='__new__'){
          var newChainId=uid();
          l.chainId=newChainId;
        } else if(chainSel){
          /* adopt the chainId of the selected predecessor */
          var pred=loans.find(function(x){return x.id===chainSel;});
          l.chainId=pred&&pred.chainId?pred.chainId:chainSel;
        } else {
          delete l.chainId;
        }
        syncStatus();save();d.closeEdit();d.loans();d.ov();d.extPopulate();d.checkAlarms();
      },
      /* ─── Duplicate loan ─── */
      dupLoan:function(i){
        var src=loans[i];
        var copy=Object.assign({},src,{
          id:uid(),
          name:src.name+' (Kopie)',
          status:'active'
        });
        loans.push(copy);
        save();d.loans();d.ov();d.extPopulate();
        /* Flash the new card briefly */
        setTimeout(function(){
          var cards=document.querySelectorAll('#ffd-root #loans-list .card');
          if(cards.length){var last=cards[cards.length-1];last.style.outline='2px solid var(--accent)';setTimeout(function(){last.style.outline='';},1200);}
        },50);
      },

      /* ─── Countdown bar ─── */
      checkCountdown:function(){
        var el=g('countdown-bar');if(!el)return;
        var act=loans.filter(function(l){return l.status==='active';});
        var soon=act.filter(function(l){return dL(l.start,l.term)>=0&&dL(l.start,l.term)<=(cfg.countdownDays||30);});
        soon.sort(function(a,b){return dL(a.start,a.term)-dL(b.start,b.term);});
        if(!soon.length){el.className='countdown-bar';el.innerHTML='';return;}
        el.className='countdown-bar show';
        el.innerHTML='<span style="font-size:11px;font-weight:600;color:var(--text3);display:block;width:100%;margin-bottom:.25rem">&#9203; Bald fällig</span>'+soon.map(function(l){
          var dl=dL(l.start,l.term);
          var urg=dl<=7,warn=dl<=14;
          var color=urg?'var(--err)':warn?'var(--warn)':'var(--text2)';
          var chipCls='cd-chip'+(urg?' urgent':(warn?' warn':''));
          return '<div class="'+chipCls+'">'+
            '<span class="cd-days" style="color:'+color+'">'+dl+'<span style="font-size:10px;font-weight:500;margin-left:2px">Tage</span></span>'+
            '<div class="cd-info">'+
              '<span class="cd-name" style="color:'+color+'">'+l.name+'</span>'+
              '<span class="cd-meta">'+fmt(l.amount,l.c)+' · '+aM(l.start,l.term).toLocaleDateString('de-CH')+'</span>'+
            '</div>'+
          '</div>';
        }).join('');
      },

      /* ─── CSV Export ─── */
      exportCSV:function(){
        var headers=['ID','Bezeichnung','Betrag','Währung','Zinssatz %','Gebühr BTC','Laufzeit Mo','Startdatum','Fälligkeitsdatum','Collateral BTC','Status','Zinsen (CCY)','Gebühr (BTC)','Fälliger Betrag (CCY)','Gebühr (USD)','LTV %','Liq.preis USD/BTC','BTC Startpreis','Roll-Over Kette','Notiz'];
        var rows=loans.map(function(l){
          var lU=toU(l.amount,l.c);
          var interest=l.amount*(l.rate/100)*(l.term/12);var feeBtcAmt=l.feeBtc||0;
          var due=dueU(l);
          var liqP=l.col>0?due/(0.95*l.col):null;
          var ltv=l.col>0?(due/(l.col*R.BTC)*100):null;
          var endDate=aM(l.start,l.term).toLocaleDateString('de-CH');
          function q(v){v=String(v===null||v===undefined?'':v);return '"'+v.replace(/"/g,'""')+'"';}
          return [
            q(l.id),q(l.name),q(l.amount),q(l.c),q(l.rate),q(l.feeBtc||0),q(l.term),
            q(l.start),q(endDate),q(l.col),q(l.status),
            q(interest.toFixed(2)),q(feeBtcAmt.toFixed(8)),q((l.amount+interest).toFixed(2)),q(feeU(l).toFixed(2)),
            q(ltv?ltv.toFixed(1):''),q(liqP?Math.round(liqP):''),
            q(l.btcStart||''),q(l.chainId||''),q(l.note||'')
          ].join(';');
        });
        var csv='\ufeff'+headers.map(function(h){return '"'+h+'"';}).join(';')+'\n'+rows.join('\n');
        var blob=new Blob([csv],{type:'text/csv;charset=utf-8'});
        var url=URL.createObjectURL(blob);
        var a=document.createElement('a');a.href=url;
        var now=new Date();
        a.download='firefish-kredite_'+now.getFullYear()+'_'+String(now.getMonth()+1).padStart(2,'0')+'_'+String(now.getDate()).padStart(2,'0')+'.csv';
        a.click();URL.revokeObjectURL(url);
      },

      exportJSON:function(){
        var exportData={
          version:2,
          settings:{
            preferredCurrencies:cfg.ccys,
            defaultTab:cfg.defaultTab||'ov',
            defaultView:cfg.defaultView||'grid',
            defaultCcy:cfg.defaultCcy||'EUR',
            ltvWarn:cfg.ltvWarn!=null?cfg.ltvWarn:73,
            ltvCrit:cfg.ltvCrit!=null?cfg.ltvCrit:79,
            ltvDanger:cfg.ltvDanger!=null?cfg.ltvDanger:86,
            ltvDisplay:cfg.ltvDisplay!=null?cfg.ltvDisplay:73,
            countdownDays:cfg.countdownDays!=null?cfg.countdownDays:30,
            hideAmounts:cfg.hideAmounts||false,
            hideBreakEven:cfg.hideBreakEven||false,
            darkMode:document.getElementById('ffd-root').classList.contains('dark')
          },
          loans:loans.map(function(l){return{id:l.id,name:l.name,amount:l.amount,currency:l.c,rate:l.rate,termMonths:l.term,startDate:l.start,collateralBtc:l.col,status:l.status,btcStart:l.btcStart||null,feeBtc:l.feeBtc||0,chainId:l.chainId||null,note:l.note||''};})
        };
        var blob=new Blob([JSON.stringify(exportData,null,2)],{type:'application/json'});
        var url=URL.createObjectURL(blob);
        var a=document.createElement('a');
        var now=new Date();var pad=function(n){return String(n).padStart(2,'0');};var ts=now.getFullYear()+'_'+pad(now.getMonth()+1)+'_'+pad(now.getDate())+'_'+pad(now.getHours())+'_'+pad(now.getMinutes());
        a.href=url;a.download='firefish-kredite_'+ts+'.json';
        document.body.appendChild(a);a.click();
        document.body.removeChild(a);URL.revokeObjectURL(url);
      },
      openImport:function(fmt){
        fmt=fmt||'json';
        window._importFmt=fmt;
        /* Reset strategy selection */
        document.querySelectorAll('#ffd-root .import-strat-btn').forEach(function(b){b.classList.remove('on');});
        var btnJ=g('import-confirm-btn'),btnC=g('import-confirm-btn-csv');
        if(btnJ){btnJ.classList.remove('active');btnJ.style.display=fmt==='json'?'':'none';}
        if(btnC){btnC.classList.remove('active');btnC.style.display=fmt==='csv'?'':'none';}
        var title=g('import-modal-title');
        if(title)title.textContent=fmt==='csv'?'↑ Import — Firefish CSV':'↑ Import — JSON';
        window._importStrat=null;
        g('import-modal-bg').classList.add('open');
      },
      closeImport:function(){g('import-modal-bg').classList.remove('open');},
      pickImportStrat:function(strat,el){
        document.querySelectorAll('#ffd-root .import-strat-btn').forEach(function(b){b.classList.remove('on');});
        el.classList.add('on');
        window._importStrat=strat;
        var fmt=window._importFmt||'json';
        var btn=fmt==='csv'?g('import-confirm-btn-csv'):g('import-confirm-btn');
        if(btn)btn.classList.add('active');
      },

      importCSV:function(input){
        var file=input.files[0];if(!file)return;
        d.closeImport();
        var strat=window._importStrat||'merge';
        var reader=new FileReader();
        reader.onload=function(e){
          var msg=g('import-msg');
          try{
            var text=e.target.result.replace(/\r\n/g,'\n').replace(/\r/g,'\n');
            var lines=text.trim().split('\n');
            if(lines.length<2)throw new Error('CSV ist leer oder hat keine Daten');
            /* Parse header */
            var hdr=lines[0].split(',').map(function(h){return h.trim().toLowerCase();});
            var col=function(name){var i=hdr.indexOf(name);return i;};
            var iId=col('loan id');
            var iStart=col('start date (dd.mm.yyyy)');
            var iMaturity=col('maturity date (dd.mm.yyyy)');
            var iRate=col('interest rate (% p.a.)');
            var iCcy=col('currency');
            var iAmount=col('loan amount');
            var iStatus=col('status');
            var iOrigFee=col('origination fee (sat)');
            var iCol=col('collateral sum (btc)');
            var iNote=col('note');
            if(iId<0||iStart<0||iAmount<0)throw new Error('CSV-Format nicht erkannt. Bitte Firefish-Export verwenden.');
            /* Helper: parse dd.m.yyyy or dd.mm.yyyy → yyyy-mm-dd */
            function parseDate(s){
              if(!s||!s.trim())return null;
              var parts=s.trim().split('.');
              if(parts.length!==3)return null;
              var d=parts[0].padStart(2,'0'),m=parts[1].padStart(2,'0'),y=parts[2];
              return y+'-'+m+'-'+d;
            }
            /* Helper: calculate termMonths from start + maturity */
            function calcTerm(startStr,endStr){
              var s=new Date(startStr),e=new Date(endStr);
              if(isNaN(s)||isNaN(e))return 12;
              var months=(e.getFullYear()-s.getFullYear())*12+(e.getMonth()-s.getMonth());
              return Math.max(1,Math.round(months));
            }
            /* Helper: sat → BTC */
            function satToBtc(satStr){
              var v=parseInt(satStr)||0;
              return v/1e8;
            }
            var imported=0,skipped=0,invalid=0;
            if(strat==='replace')loans.length=0;
            var existingIds=loans.map(function(l){return l.id;});
            for(var i=1;i<lines.length;i++){
              var row=lines[i].split(',');
              if(row.length<5)continue;
              var id=(row[iId]||'').trim();
              var startRaw=iStart>=0?(row[iStart]||'').trim():'';
              var maturityRaw=iMaturity>=0?(row[iMaturity]||'').trim():'';
              var startDate=parseDate(startRaw);
              var maturityDate=parseDate(maturityRaw);
              var amount=parseFloat(row[iAmount])||0;
              if(!id||!startDate||!amount){invalid++;continue;}
              if(strat==='skip'&&existingIds.indexOf(id)>=0){skipped++;continue;}
              var ccy=(iCcy>=0?(row[iCcy]||'').trim():'EUR')||'EUR';
              var rate=parseFloat(iRate>=0?row[iRate]:0)||0;
              var term=calcTerm(startDate,maturityDate);
              var statusRaw=iStatus>=0?(row[iStatus]||'').trim().toUpperCase():'ACTIVE';
              var status=statusRaw==='CLOSED'?'closed':'active';
              var origFeeBtc=iOrigFee>=0?satToBtc(row[iOrigFee]):0;
              var colBtc=parseFloat(iCol>=0?row[iCol]:0)||0;
              var note=iNote>=0?(row[iNote]||'').trim():'';
              /* Loan name: currency + formatted amount */
              var name=ccy+' '+parseFloat(amount).toLocaleString('de-CH',{maximumFractionDigits:0});
              loans.push({
                id:id,
                name:name,
                amount:amount,
                c:ccy,
                rate:rate,
                term:term,
                start:startDate,
                col:colBtc,
                status:status,
                btcStart:null,
                feeBtc:origFeeBtc,
                note:note
              });
              imported++;
            }
            var stratLabel={'merge':'zusammengef\u00fchrt','skip':'importiert ('+skipped+' Duplikat(e) \u00fcbersprungen)','replace':'ersetzt'}[strat];
            var warn=invalid>0?' · '+invalid+' Zeile(n) \u00fcbersprungen (unvollst\u00e4ndig).':'';
            syncStatus();save();d.loans();d.extPopulate();d.checkAlarms();d.ov();
            msg.style.display='block';
            msg.style.background='var(--ok-bg)';msg.style.color='var(--ok)';msg.style.border='1px solid var(--ok-border)';
            msg.textContent='\u2713 '+imported+' Kredit(e) aus CSV '+stratLabel+'.'+warn;
          }catch(err){
            msg.style.display='block';
            msg.style.background='var(--err-bg)';msg.style.color='var(--err)';msg.style.border='1px solid var(--err-border)';
            msg.textContent='\u2717 CSV-Import fehlgeschlagen: '+err.message;
          }
          setTimeout(function(){msg.style.display='none';},5000);
          input.value='';
        };
        reader.readAsText(file,'UTF-8');
      },
      importJSON:function(input){
        var file=input.files[0];if(!file)return;
        d.closeImport();
        var strat=window._importStrat||'merge';
        var reader=new FileReader();
        reader.onload=function(e){
          var msg=g('import-msg');
          try{
            var parsed=JSON.parse(e.target.result);
            var loanArr=Array.isArray(parsed)?parsed:(parsed.loans||[]);
            var importedSettings=(!Array.isArray(parsed)&&parsed.settings)||null;
            if(!Array.isArray(loanArr))throw new Error('Ungültiges Format');
            var imported=0,skipped=0;
            if(strat==='replace'){
              loans.length=0;
            }
            var existingIds=loans.map(function(l){return l.id;});
            loanArr.forEach(function(l){
              if(!l.name||!l.amount||(!(l.startDate)&&!(l.start)))return;
              var newId=l.id||uid();
              if(strat==='skip'&&existingIds.indexOf(newId)>=0){skipped++;return;}
              loans.push({
                id:newId,
                name:l.name,amount:parseFloat(l.amount)||0,
                c:l.currency||l.c||'EUR',
                rate:parseFloat(l.rate)||0,
                term:parseInt(l.termMonths||l.term)||12,
                start:l.startDate||l.start,
                col:parseFloat(l.collateralBtc||l.col)||0,
                status:l.status||'active',
                btcStart:l.btcStart||null,
                feeBtc:parseFloat(l.feeBtc)||0,
                chainId:l.chainId||undefined,
                note:l.note||''
              });
              imported++;
            });
            var settingsNote='';
            if(importedSettings&&Array.isArray(importedSettings.preferredCurrencies)&&importedSettings.preferredCurrencies.length){
              cfg.ccys=importedSettings.preferredCurrencies;
              if(importedSettings.defaultTab)cfg.defaultTab=importedSettings.defaultTab;
              if(importedSettings.defaultView)cfg.defaultView=importedSettings.defaultView;
              if(importedSettings.defaultCcy)cfg.defaultCcy=importedSettings.defaultCcy;
              if(importedSettings.ltvWarn!=null)cfg.ltvWarn=importedSettings.ltvWarn;
              if(importedSettings.ltvCrit!=null)cfg.ltvCrit=importedSettings.ltvCrit;
              if(importedSettings.ltvDanger!=null)cfg.ltvDanger=importedSettings.ltvDanger;
              if(importedSettings.ltvDisplay!=null){cfg.ltvDisplay=importedSettings.ltvDisplay;ltvThresh=cfg.ltvDisplay;}
              if(importedSettings.countdownDays!=null)cfg.countdownDays=importedSettings.countdownDays;
              if(importedSettings.hideAmounts!=null)cfg.hideAmounts=importedSettings.hideAmounts;
              if(importedSettings.hideBreakEven!=null)cfg.hideBreakEven=importedSettings.hideBreakEven;
              if(importedSettings.darkMode!=null){var r=document.getElementById('ffd-root');if(importedSettings.darkMode){r.classList.add('dark');localStorage.setItem('ffd_dark','1');}else{r.classList.remove('dark');localStorage.setItem('ffd_dark','');}var db=g('dark-btn');if(db)db.textContent=importedSettings.darkMode?'☀':'☾';}
              saveSettings(cfg);
              lView=cfg.defaultView||'grid';
              d.renderCsw();
              settingsNote=' · Einstellungen importiert.';
            }
            var stratLabel={'merge':'zusammengeführt','skip':'importiert ('+skipped+' Duplikat(e) übersprungen)','replace':'ersetzt'}[strat];
            syncStatus();save();d.loans();d.extPopulate();d.checkAlarms();
            msg.style.display='block';
            msg.style.background='var(--ok-bg)';msg.style.color='var(--ok)';msg.style.border='1px solid var(--ok-border)';
            msg.textContent='✓ '+imported+' Kredit(e) '+stratLabel+'.'+settingsNote;
          }catch(err){
            msg.style.display='block';
            msg.style.background='var(--err-bg)';msg.style.color='var(--err)';msg.style.border='1px solid var(--err-border)';
            msg.textContent='✗ Import fehlgeschlagen: '+err.message;
          }
          setTimeout(function(){msg.style.display='none';},4000);
          input.value='';
        };
        reader.readAsText(file);
      },
      ltv:function(){
        var l=parseFloat(g('tl').value),col=parseFloat(g('tc2').value),c=g('tc').value;
        if(!l||!col){g('ltv-r').style.display='none';return;}
        var lU=toU(l,c),cU=col*R.BTC,ltv=(lU/cU)*100;
function mc(t){var r=parseFloat(g('ber')?g('ber').value:0)||0;var tm=parseInt(g('bet')?g('bet').value:12)||12;var intU=toU(parseFloat(g('tl').value)||0,g('tc').value)*(r/100)*(tm/12);return((lU+intU)/(t/100))/col;}
        g('ltv-r').style.display='block';
        g('rcol-usd').textContent=fmt(cU,'USD');
        g('rcol-ccy').textContent=fmt(frU(cU,c),c);
        g('rltv').innerHTML='<span style="color:'+lc(ltv)+'">'+ltv.toFixed(2)+'%</span>';
        g('rmc1').textContent='$ '+mc(73).toLocaleString('de-CH',{maximumFractionDigits:0});
        g('rmc2').textContent='$ '+mc(79).toLocaleString('de-CH',{maximumFractionDigits:0});
        g('rmc3').textContent='$ '+mc(86).toLocaleString('de-CH',{maximumFractionDigits:0});
        g('rliq').textContent='$ '+mc(95).toLocaleString('de-CH',{maximumFractionDigits:0});
        var w=g('ltv-w');
        if(ltv>=86){w.style.display='block';w.innerHTML='<span class="err">⚠ Kritisch: LTV nahe Liquidation!</span>';}
        else if(ltv>=73){w.style.display='block';w.innerHTML='<span class="wrn">⚠ Margin Call Zone.</span>';}
        else w.style.display='none';
      },
      se2Populate:function(){
        var sel=g('se2-loan-sel');if(!sel)return;
        var act=loans.filter(function(l){return l.status==='active';})
          .slice().sort(function(a,b){return aM(a.start,a.term)-aM(b.start,b.term);});
        var cur=sel.value;
        sel.innerHTML='<option value="">\u2014 Kredit w\u00e4hlen \u2014</option>'+
          act.map(function(l){var i=loans.indexOf(l);return '<option value="'+i+'">'+l.name+' ('+fmt(l.amount,l.c)+')</option>';}).join('');
        if(cur)sel.value=cur;
      },
      se2Fill:function(){
        var sel=g('se2-loan-sel');if(!sel||!sel.value)return;
        var l=loans[parseInt(sel.value)];if(!l)return;
        var calcInterest=l.amount*(l.rate/100)*(l.term/12);
        var dueUSD=toU(l.amount,l.c)+toU(calcInterest,l.c);
        var ccy=d.vorGetCcy();
        g('se2-due').value=parseFloat(frU(dueUSD,ccy).toFixed(ccy==='CZK'||ccy==='PLN'?0:2));
        if(l.col)g('se2-col').value=l.col;
        d.se2();
      },
      se2:function(){
        var due=d.vorReadUSD('se2-due');
        var col=parseFloat(g('se2-col').value);
        var targetCcy=parseFloat((g('se2-target').value+'').replace(/[^\d.-]/g,''))||0;
        var target=targetCcy?toU(targetCcy,d.vorGetCcy()):0;
        if(!due||!col){g('se2-r').style.display='none';return;}
        var oldLiq=due/(col*0.95);
        g('se2-r').style.display='block';
        g('se2-old').textContent=d.vorFmt(Math.round(oldLiq));
        if(!target){g('se2-add').textContent='–';return;}
        var add=(due/(target*0.95))-col;
        if(add<=0){
          g('se2-add').innerHTML='<span style="color:var(--ok)">&#10003; Kein Nachschuss n&#246;tig</span>';
        } else {
          g('se2-add').textContent=(Math.ceil(add*100000)/100000).toFixed(5)+' BTC';
        }
      },
      nlpPopulate:function(){
        var sel=g('nlp-loan-sel');if(!sel)return;
        var act=loans.filter(function(l){return l.status==='active';})
          .slice().sort(function(a,b){return aM(a.start,a.term)-aM(b.start,b.term);});
        var cur=sel.value;
        sel.innerHTML='<option value="">\u2014 Kredit w\u00e4hlen \u2014</option>'+
          act.map(function(l){var i=loans.indexOf(l);return '<option value="'+i+'">'+l.name+' ('+fmt(l.amount,l.c)+')</option>';}).join('');
        if(cur)sel.value=cur;
      },
      nlpFill:function(){
        var sel=g('nlp-loan-sel');if(!sel||!sel.value)return;
        var l=loans[parseInt(sel.value)];if(!l)return;
        var calcInterest=l.amount*(l.rate/100)*(l.term/12);
        var dueUSD=toU(l.amount,l.c)+toU(calcInterest,l.c);
        var ccy=d.vorGetCcy();
        g('nlp-due').value=parseFloat(frU(dueUSD,ccy).toFixed(ccy==='CZK'||ccy==='PLN'?0:2));
        if(l.col)g('nlp-col').value=l.col;
        d.nlp();
      },
      nlp:function(){
        var due=d.vorReadUSD('nlp-due');
        var col=parseFloat(g('nlp-col').value);
        var add=parseFloat(g('nlp-add').value)||0;
        if(!due||!col){g('nlp-r').style.display='none';return;}
        var oldLiq=due/(col*0.95);
        var newLiq=due/((col+add)*0.95);
        var diff=oldLiq-newLiq;
        g('nlp-r').style.display='block';
        g('nlp-old').textContent=d.vorFmt(Math.round(oldLiq));
        g('nlp-new').textContent=d.vorFmt(Math.round(newLiq));
        g('nlp-diff').innerHTML='<span style="color:var(--ok)">&#8722; '+d.vorFmt(Math.round(diff))+'</span>';
      },
      nachPopulate:function(){
        var sel=g('cn-loan-sel');if(!sel)return;
        var act=loans.filter(function(l){return l.status==='active';});
        var cur=sel.value;
        sel.innerHTML='<option value="">\u2014 Kredit w\u00e4hlen \u2014</option>'+
          act.map(function(l){var i=loans.indexOf(l);return '<option value="'+i+'">'+l.name+' ('+fmt(l.amount,l.c)+')</option>';}).join('');
        if(cur)sel.value=cur;
      },
      nachFill:function(){
        var sel=g('cn-loan-sel');if(!sel||!sel.value)return;
        var l=loans[parseInt(sel.value)];if(!l)return;
        var lU=toU(l.amount,l.c);
        var ccy=d.vorGetCcy();
        g('cnl').value=parseFloat(frU(lU,ccy).toFixed(ccy==='CZK'||ccy==='PLN'?0:2));
        if(l.col)g('cncol').value=l.col;
        d.nach();
      },
      nach:function(){
        var lU=d.vorReadUSD('cnl'),col=parseFloat(g('cncol').value);
        if(!lU||!col){g('cn-r').style.display='none';return;}
        var cU=col*R.BTC,ltv=(lU/cU)*100;
        function nb(t){return Math.max(0,(lU/(t/100))/R.BTC-col);}
        g('cn-r').style.display='block';
        g('cnltv').innerHTML='<span style="color:'+lc(ltv)+'">'+ltv.toFixed(2)+'%</span>';
        g('cn50').textContent=nb(50)>0?'+ '+nb(50).toFixed(8)+' BTC':'✓ Bereits ausreichend';
        g('cn75').textContent=nb(75)>0?'+ '+nb(75).toFixed(8)+' BTC':'✓ Kein Nachschuss nötig';
        g('cn95').textContent=nb(95)>0?'+ '+nb(95).toFixed(8)+' BTC':'✓ Kein Nachschuss nötig';
      },
      be:function(){
        var l=parseFloat(g('bel').value),r=parseFloat(g('ber').value),t=parseInt(g('bet').value),bp=parseFloat(g('bebp').value),c=g('bec').value;
        if(!l||!r||!bp){g('be-r').style.display='none';return;}
        var vorCcy=d.vorGetCcy();
        var bpUSD=toU(bp,vorCcy); /* convert BTC price from vorCcy to USD */
        var interest=l*(r/100)*(t/12),fee=parseFloat(g('befee').value)||0,feeUSD=fee*R.BTC,iU=toU(interest,c),lU=toU(l,c),dueUSD=lU+iU+feeUSD,sold=lU/bpUSD,bep=bpUSD*(dueUSD/lU);
        g('be-r').style.display='block';
        g('becost').textContent=fmt(interest,c);g('becostusd').textContent=fmt(iU,'USD');
        g('bebtc').textContent=sold.toFixed(8)+' BTC';
        var bepDisp=frU(bep,vorCcy);
        g('bebep').textContent=fmt(bepDisp,vorCcy);
        var v=g('be-v');
        if(liveBtc){v.style.display='block';v.innerHTML=liveBtc>bep?'<span class="ok">✓ Kredit hat sich gelohnt.</span>':'<span class="wrn">⚠ BTC noch unter Break-even.</span>';}
        else v.style.display='none';
      },
      conv:function(){
        var a=parseFloat(g('cva').value),f=g('cvf').value;
        if(!a){g('cv-r').style.display='none';return;}
        g('cv-r').style.display='block';
        g('cv-grid').innerHTML=['EUR','CHF','USD','USDT','USDC','CZK','PLN','BTC','SAT'].filter(visC).map(function(c){
          return '<div class="ccyc"><span class="ccy-lbl">'+c+'</span><span class="ccy-val">'+fmt(frU(toU(a,f),c),c)+'</span></div>';
        }).join('');
      },
      renderHeatmap:function(){
        var heatEl=g('ch-heat');if(!heatEl)return;
        var act=loans.filter(function(l){return l.status==='active';});
        if(!act.length){heatEl.innerHTML='<div class="empty" style="text-align:center;padding:2rem">Keine aktiven Kredite.</div>';return;}
        var heatLoans=act.filter(function(l){return l.col>0;});
        if(!heatLoans.length){heatEl.innerHTML='<p class="note2" style="text-align:center;padding:2rem">Kein Collateral hinterlegt.</p>';return;}
        var priceMin=Math.round(R.BTC*0.30/1000)*1000;
        var priceMax=Math.round(R.BTC*1.50/1000)*1000;
        var steps=12;
        var priceStep=Math.round((priceMax-priceMin)/steps/1000)*1000||1000;
        var prices=[];
        for(var px=priceMin;px<=priceMax;px+=priceStep)prices.push(px);
        var labelCols=prices.map(function(p){
          var k=p>=1000?'$'+Math.round(p/1000)+'k':'$'+p;
          var isCur=Math.abs(p-R.BTC)<priceStep/2;
          return '<div style="flex:1;text-align:center;font-size:9px;color:'+(isCur?'var(--accent)':'var(--text4)')+';font-weight:'+(isCur?700:400)+';white-space:nowrap">'+k+(isCur?'◂':'')+' </div>';
        }).join('');
        var rows=heatLoans.map(function(l){
          var due=toU(l.amount,l.c)+intU(l);
          var cells=prices.map(function(p){
            var ltv=due/(l.col*p)*100;
            var bg,fc;
            if(ltv>=95){bg='#dc2626';fc='#fff';}
            else if(ltv>=86){bg='#ea580c';fc='#fff';}
            else if(ltv>=73){bg='#d97706';fc='#fff';}
            else if(ltv>=60){bg='rgba(249,115,22,.18)';fc='var(--text2)';}
            else{bg='rgba(22,163,74,.12)';fc='var(--text3)';}
            var isCur=Math.abs(p-R.BTC)<priceStep/2;
            return '<div style="flex:1;text-align:center;font-size:9px;padding:3px 1px;background:'+bg+';color:'+fc+';border-left:'+(isCur?'2px solid var(--accent)':'1px solid var(--bg)')+';white-space:nowrap">'+Math.round(ltv)+'%</div>';
          }).join('');
          return '<div style="display:flex;align-items:stretch;margin-bottom:2px">'+
            '<div style="width:90px;flex-shrink:0;font-size:11px;font-weight:600;color:var(--text2);padding-right:6px;display:flex;align-items:center;overflow:hidden;white-space:nowrap;text-overflow:ellipsis">'+l.name+'</div>'+
            '<div style="flex:1;display:flex;border-radius:4px;overflow:hidden">'+cells+'</div>'+
          '</div>';
        }).join('');
        var legend='<div style="display:flex;gap:8px;flex-wrap:wrap;margin-top:.75rem;font-size:10px">'+
          '<span style="display:flex;align-items:center;gap:4px"><span style="width:12px;height:12px;border-radius:2px;background:rgba(22,163,74,.2);display:inline-block"></span>Sicher</span>'+
          '<span style="display:flex;align-items:center;gap:4px"><span style="width:12px;height:12px;border-radius:2px;background:rgba(249,115,22,.18);display:inline-block"></span>Beobachten</span>'+
          '<span style="display:flex;align-items:center;gap:4px"><span style="width:12px;height:12px;border-radius:2px;background:#d97706;display:inline-block"></span>MC1 \u226573%</span>'+
          '<span style="display:flex;align-items:center;gap:4px"><span style="width:12px;height:12px;border-radius:2px;background:#ea580c;display:inline-block"></span>MC3 \u226586%</span>'+
          '<span style="display:flex;align-items:center;gap:4px"><span style="width:12px;height:12px;border-radius:2px;background:#dc2626;display:inline-block"></span>Liq \u226595%</span>'+
        '</div>';
        heatEl.innerHTML=
          '<div style="display:flex;margin-bottom:3px">'+
            '<div style="width:90px;flex-shrink:0"></div>'+
            '<div style="flex:1;display:flex">'+labelCols+'</div>'+
          '</div>'+
          rows+legend;
      },
      stress:function(){
        var bp=R.BTC;g('st-btc').textContent='$ '+bp.toLocaleString('de-CH',{maximumFractionDigits:0});
        var el=g('st-r'),act=loans.filter(function(l){return l.status==='active';});
        if(!act.length){el.innerHTML='<div class="empty">Keine aktiven Kredite.</div>';return;}
        var sc=[-10,-20,-30,-40,-50,-60,-70,-80];
        /* Helper: MC price for given LTV threshold (Kapital + Zinsen, ohne Gebühren) */
        function stDue(l){return toU(l.amount,l.c)+intU(l);}
        function mcP(l,t){if(!l.col)return null;return stDue(l)/(t/100)/l.col;}
        function liqP(l){if(!l.col)return null;return stDue(l)/(0.95*l.col);}
        function pFmt(usd,l){return usd?'$'+Math.round(usd).toLocaleString('de-CH'):'–';}
        var h='<div class="ovx"><table><thead><tr>'+
          '<th style="min-width:90px">Szenario</th>';
        act.forEach(function(l){
          h+='<th style="min-width:130px">'+l.name+
            '<br><span style="font-weight:400;color:var(--text4);font-size:10px">'+l.c+' · '+l.col+' BTC</span>'+
          '</th>';
        });
        h+='</tr></thead><tbody>';
        /* ── Aktueller LTV ── */
        h+='<tr style="border-bottom:2px solid var(--border)"><td style="font-weight:700;font-size:12px">Aktuell</td>';
        act.forEach(function(l){
          var v=l.col>0?stDue(l)/(l.col*bp)*100:0;
          h+='<td><span class="chip" style="background:'+lc(v)+'22;color:'+lc(v)+'">'+v.toFixed(1)+'%</span></td>';
        });
        h+='</tr>';
        /* ── MC / Liquidation trigger prices ── */
        var mcRows=[
          {label:'MC 1 (73%)',thresh:73,color:'#d97706'},
          {label:'MC 2 (79%)',thresh:79,color:'#ea580c'},
          {label:'MC 3 (86%)',thresh:86,color:'#dc2626'},
          {label:'Liquidation (95%)',thresh:95,color:'#7c3aed'},
        ];
        mcRows.forEach(function(mc){
          h+='<tr style="background:var(--bg2)"><td style="font-size:11px;font-weight:600;color:'+mc.color+';white-space:nowrap;background:var(--bg2)">'+
            mc.label+'<br><span style="font-size:10px;font-weight:400;color:var(--text4)">BTC-Preis</span></td>';
          act.forEach(function(l){
            var price=mc.thresh===95?liqP(l):mcP(l,mc.thresh);
            var pct=price?((bp-price)/bp*100):null;
            var reached=price&&bp<=price;
            h+='<td style="font-size:12px">'+
              '<span style="font-weight:600;color:'+(reached?'#dc2626':mc.color)+'">'+pFmt(price,l)+'</span>'+
              (pct!==null?'<br><span style="font-size:10px;color:var(--text4)">'+(reached?'⚠ bereits erreicht':'↓ '+pct.toFixed(1)+'% Puffer')+'</span>':'')+
            '</td>';
          });
          h+='</tr>';
        });
        /* ── Szenarien ── */
        h+='<tr><td colspan="'+(act.length+1)+'" style="padding:.4rem .75rem;font-size:10px;font-weight:700;color:var(--text4);text-transform:uppercase;letter-spacing:.05em;background:var(--bg3)">LTV-Szenarien</td></tr>';
        sc.forEach(function(p){
          var pp=bp*(1+p/100);
          h+='<tr><td style="color:'+(p<=-50?'#dc2626':'#d97706')+';font-weight:600;font-size:12px;white-space:nowrap">'+
            p+'%<br><span style="font-size:10px;font-weight:400;color:var(--text3)">$'+Math.round(pp).toLocaleString('de-CH')+'</span></td>';
          act.forEach(function(l){
            var v=l.col>0?stDue(l)/(l.col*pp)*100:0;
            var lb=v>=95?'LIQ':v>=86?'MC3':v>=79?'MC2':v>=73?'MC1':'OK';
            var ok=lb==='OK';
            h+='<td><span class="chip" style="background:'+lc(v)+'22;color:'+lc(v)+'">'+(ok?v.toFixed(0)+'%':v.toFixed(0)+'% '+lb)+'</span></td>';
          });
          h+='</tr>';
        });
        el.innerHTML=h+'</tbody></table></div>';
        d.renderHeatmap();
      },
      cal:function(){
        var MN=['Januar','Februar','März','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember'];
        var DN=['Mo','Di','Mi','Do','Fr','Sa','So'];
        g('cal-title').textContent=MN[calM]+' '+calY;
        var grid=g('cal-grid');grid.innerHTML='';
        DN.forEach(function(dn){var h=document.createElement('div');h.className='ch';h.textContent=dn;grid.appendChild(h);});
        var first=new Date(calY,calM,1),sd=(first.getDay()+6)%7,dim=new Date(calY,calM+1,0).getDate(),today=new Date();
        var evts={};
        loans.forEach(function(l){var e=aM(l.start,l.term);if(e.getFullYear()===calY&&e.getMonth()===calM){var dd=e.getDate();if(!evts[dd])evts[dd]=[];evts[dd].push({name:l.name,urg:dL(l.start,l.term)<=14});}});
        for(var i=0;i<sd;i++){var e=document.createElement('div');e.className='cd';grid.appendChild(e);}
        for(var day=1;day<=dim;day++){
          var cell=document.createElement('div');cell.className='cd';
          if(today.getFullYear()===calY&&today.getMonth()===calM&&today.getDate()===day)cell.classList.add('today');
          cell.innerHTML='<span class="cdn">'+day+'</span>';
          if(evts[day])evts[day].forEach(function(ev){cell.innerHTML+='<span class="ce'+(ev.urg?' due':'')+'">'+ev.name+'</span>';});
          grid.appendChild(cell);
        }
        var up=loans.filter(function(l){return l.status==='active';}).map(function(l){return Object.assign({},l,{days:dL(l.start,l.term),end:aM(l.start,l.term)});}).filter(function(l){return l.days>0;}).sort(function(a,b){return a.days-b.days;});
        g('upcoming').innerHTML=up.length?up.map(function(l){
          var lU=toU(l.amount,l.c);
          return '<div class="card" style="padding:.75rem 1rem">'+
            '<div class="fxsb"><span style="font-size:13px;font-weight:600;color:var(--text)">'+l.name+' <span style="font-weight:400;color:#9ca3af">'+l.c+'</span></span>'+
            '<span style="font-size:12px;color:'+(l.days<14?'#dc2626':l.days<30?'#d97706':'#6b7280')+';font-weight:600">'+(l.days<14?'⚠ ':'')+l.days+' Tage — '+l.end.toLocaleDateString('de-CH')+'</span></div>'+
            '<p class="note2 amt" style="margin-top:3px">'+fmt(l.amount,l.c)+' · '+l.rate+'% p.a. · '+l.col+' BTC</p>'+
            '<p class="note amt" style="margin-top:2px">= '+fmt(lU,'USD')+' / '+fmt(frU(lU,'CHF'),'CHF')+' / '+fmt(frU(lU,'EUR'),'EUR')+'</p>'+
          '</div>';
        }).join(''):'<div class="empty">Keine bevorstehenden Fälligkeiten</div>';
      },
      calPrev:function(){calM--;if(calM<0){calM=11;calY--;}d.cal();},
      calNext:function(){calM++;if(calM>11){calM=0;calY++;}d.cal();},
      ccy:function(ccy,btn){
        document.querySelectorAll('#ffd-root .cb').forEach(function(b){b.classList.remove('on');});
        btn.classList.add('on');dCcy=ccy;d.debtChart(ccy);
      },
      debtChart:function(ccy){
        if(typeof Chart==='undefined')return;
        var _dcCs=getComputedStyle(document.getElementById('ffd-root'));
        var chGridColor=_dcCs.getPropertyValue('--border').trim();
        var chTextColor=_dcCs.getPropertyValue('--text3').trim();
        var months=[],now=new Date();
        /* Build monthly points: 12 months back, current month, up to latest due + 2 months */
        var PAST=12;
        var latestDue=loans.length?new Date(Math.max.apply(null,loans.map(function(l){return aM(l.start,l.term);}))):new Date(now.getFullYear(),now.getMonth()+12,1);
        var futureEnd=new Date(latestDue.getFullYear(),latestDue.getMonth()+2,1);
        var futureMonths=Math.max(1,Math.round((futureEnd-new Date(now.getFullYear(),now.getMonth(),1))/(1000*60*60*24*30.44)));
        for(var i=-PAST;i<=futureMonths;i++)months.push(new Date(now.getFullYear(),now.getMonth()+i,1));
        var ni=PAST; /* index of "today" */
        /* Fiat debt per month (USD internally, converted to ccy for display) */
        var data=months.map(function(m,mi){
          var mY=m.getFullYear(),mM=m.getMonth();
          return frU(loans.reduce(function(s,l){
            var lStart=new Date(l.start);
            var lEnd=aM(l.start,l.term);
            var startY=lStart.getFullYear(),startM=lStart.getMonth();
            var endY=lEnd.getFullYear(),endM=lEnd.getMonth();
            var startedByThisMonth=(startY<mY)||(startY===mY&&startM<=mM);
            var endsAfterThisMonth=(endY>mY)||(endY===mY&&endM>=mM);
            if(!startedByThisMonth||!endsAfterThisMonth)return s;
            if(l.status==='closed'&&mi>ni)return s;
            return s+toU(l.amount,l.c)+intU(l);
          },0),ccy);
        });
        var lbls=months.map(function(m){return m.toLocaleDateString('de-CH',{month:'short',year:'2-digit'});});

        /* Render function — called immediately (current BTC price) then updated with hist prices */
        var histBtcMap={}; /* ISO → USD price */
        function renderChart(){
          /* BTC equivalent per month: past = hist price, present/future = R.BTC */
          var dataBtc=months.map(function(m,mi){
            var debtUSD=toU(data[mi],ccy);
            var iso=m.getFullYear()+'-'+String(m.getMonth()+1).padStart(2,'0')+'-01';
            var btcPrice=(mi<ni&&histBtcMap[iso])?histBtcMap[iso]:R.BTC;
            return btcPrice>0?parseFloat((debtUSD/btcPrice).toFixed(6)):0;
          });
          if(chD){chD.destroy();chD=null;}
          var ctx=g('debt-chart');if(!ctx)return;
          var _dcTodayPlugin={id:'dcToday',afterDraw:function(chart){
            var meta=chart.getDatasetMeta(0);if(!meta||!meta.data||!meta.data[ni])return;
            var x=meta.data[ni].x;
            var yA=chart.scales.y;if(!yA)return;
            var ctx2=chart.ctx;
            ctx2.save();ctx2.beginPath();ctx2.moveTo(x,yA.top);ctx2.lineTo(x,yA.bottom);
            ctx2.strokeStyle='#ef4444';ctx2.lineWidth=2;ctx2.setLineDash([4,3]);ctx2.stroke();ctx2.restore();
          }};
          chD=new Chart(ctx,{type:'line',data:{labels:lbls,datasets:[
            {data:data.map(function(v,i){return i<=ni?v:null;}),borderColor:'#F97316',backgroundColor:'rgba(249,115,22,.10)',fill:true,tension:0.35,borderWidth:2,spanGaps:false,pointRadius:data.map(function(_,i){return i===ni?5:i<ni?2:0;}),pointBackgroundColor:'#F97316',yAxisID:'y'},
            {data:data.map(function(v,i){return i>=ni?v:null;}),borderColor:'#F97316',borderDash:[5,4],backgroundColor:'rgba(249,115,22,.04)',fill:true,tension:0.35,borderWidth:1.5,spanGaps:false,pointRadius:data.map(function(_,i){return i===ni?5:i>ni?2:0;}),pointBackgroundColor:'#F97316',yAxisID:'y'},
            {data:dataBtc.map(function(v,i){return i<=ni?v:null;}),borderColor:'#F59E0B',backgroundColor:'transparent',fill:false,tension:0.35,borderWidth:1.5,spanGaps:false,pointRadius:dataBtc.map(function(_,i){return i===ni?4:i<ni?1:0;}),pointBackgroundColor:'#F59E0B',borderDash:[3,2],yAxisID:'yBtc'},
            {data:dataBtc.map(function(v,i){return i>=ni?v:null;}),borderColor:'#F59E0B',backgroundColor:'transparent',fill:false,tension:0.35,borderWidth:1,spanGaps:false,pointRadius:dataBtc.map(function(_,i){return i===ni?4:i>ni?1:0;}),pointBackgroundColor:'#F59E0B',borderDash:[2,3],yAxisID:'yBtc'}
          ]},options:{responsive:true,maintainAspectRatio:false,interaction:{mode:'index',intersect:false},
            plugins:{legend:{display:false},tooltip:{callbacks:{
              label:function(x){
                if(x.dataset.yAxisID==='yBtc')return ' \u20bf '+x.parsed.y.toFixed(4)+' BTC';
                return ' '+fmt(x.parsed.y,ccy);
              },
              title:function(it){var i=it[0].dataIndex;return lbls[i]+(i===ni?' (heute)':i<ni?' (vergangen)':' (Prognose)');}
            }}},
            scales:{
              y:{min:0,ticks:{color:chTextColor,callback:function(v){return fax(v,ccy);},maxTicksLimit:6},grid:{color:chGridColor},position:'left'},
              yBtc:{position:'right',ticks:{color:chTextColor,callback:function(v){return v.toFixed(2)+'\u20bf';},maxTicksLimit:6},grid:{display:false},title:{display:true,text:'BTC',font:{size:10},color:chTextColor}},
              x:{grid:{display:false},ticks:{color:chTextColor,maxRotation:45,autoSkip:true,maxTicksLimit:10}}
            }
          },plugins:[_dcTodayPlugin]});
          var aN=data[ni];
          var histData=data.slice(0,ni+1);
          var pk=Math.max.apply(null,histData),pkI=data.indexOf(pk);
          var nd=-1,sf=-1;
          for(var i=ni+1;i<data.length;i++){if(nd<0&&data[i]<aN)nd=i;}
          for(var i=ni+1;i<data.length;i++){if(sf<0&&data[i]===0)sf=i;}
          g('debt-stats').innerHTML=
            '<div class="stat"><span class="stat-lbl">Aktuell offen</span><span class="stat-val">'+fmt(aN,ccy)+'</span></div>'+
            '<div class="stat"><span class="stat-lbl">Maximum</span><span class="stat-val">'+fmt(pk,ccy)+'<br><span style="font-size:10px;color:var(--text4)">'+lbls[pkI]+'</span></span></div>'+
            '<div class="stat"><span class="stat-lbl">Nächste Reduktion</span><span class="stat-val">'+(nd>=0?lbls[nd]:'–')+'</span></div>'+
            '<div class="stat"><span class="stat-lbl">Schuldfrei</span><span class="stat-val">'+(sf>=0?lbls[sf]:'–')+'</span></div>';
        }

        /* Render immediately with current BTC price, then reload with hist prices */
        renderChart();

        /* Load historical BTC prices for past months */
        var pastMonths=months.slice(0,ni); /* exclude current month */
        var done=0;
        if(!pastMonths.length)return;
        pastMonths.forEach(function(m){
          var iso=m.getFullYear()+'-'+String(m.getMonth()+1).padStart(2,'0')+'-01';
          d.btcHistPrice(iso,function(usd){
            if(usd)histBtcMap[iso]=usd;
            done++;
            if(done===pastMonths.length)renderChart();
          });
        });
      },
      ch:function(){
        if(typeof Chart==='undefined')return;
        if(!loans.length){
          var ce=g('ch-content')||g('s-ch');
          if(ce)ce.innerHTML='<div class="empty" style="padding:2rem;text-align:center">Noch keine Kredite vorhanden. Diagramme werden nach dem Erfassen von Krediten angezeigt.</div>';
          return;
        }
        /* Apply dark-mode aware defaults to all Chart.js instances */
        (function(){
          var cs=getComputedStyle(document.getElementById('ffd-root'));
          var tc=cs.getPropertyValue('--text3').trim();
          var gc=cs.getPropertyValue('--border').trim();
          Chart.defaults.color=tc;
          Chart.defaults.borderColor=gc;
        })();
        setTimeout(function(){
          var COLORS=['#F97316','#3B82F6','#10B981','#8B5CF6','#EF4444','#F59E0B','#06B6D4','#EC4899'];
          var act=loans.filter(function(l){return l.status==='active';});
          var all=loans;
          function mk(id){var c=g(id);if(c)c.getContext('2d');return g(id);}
          function dst(ch){if(ch){ch.destroy();}return null;}
          /* Dynamic colors from CSS vars for dark mode */
          var _cs=getComputedStyle(document.getElementById('ffd-root'));
          var chTextColor=_cs.getPropertyValue('--text3').trim();
          var chGridColor=_cs.getPropertyValue('--border').trim();
          var chText2Color=_cs.getPropertyValue('--text2').trim();
          var chTextMain=_cs.getPropertyValue('--text').trim();
          var chCardBg=_cs.getPropertyValue('--card-bg').trim();
          /* Factory: vertical "Heute" line plugin for Chart.js charts with monthly labels */
          function makeTodayPlugin(labels){
            var now_tp=new Date();
            var todayLbl=new Date(now_tp.getFullYear(),now_tp.getMonth(),1).toLocaleDateString('de-CH',{month:'short',year:'2-digit'});
            var idx=labels.indexOf(todayLbl);
            return {id:'todayLine',afterDraw:function(chart){
              if(idx<0)return;
              var meta=chart.getDatasetMeta(0);if(!meta||!meta.data||!meta.data[idx])return;
              var x=meta.data[idx].x;
              var yA=chart.scales.y||chart.scales.yBtc||Object.values(chart.scales).find(function(s){return s.axis==='y';});
              if(!yA)return;
              var ctx2=chart.ctx;
              ctx2.save();ctx2.beginPath();ctx2.moveTo(x,yA.top);ctx2.lineTo(x,yA.bottom);
              ctx2.strokeStyle='#ef4444';ctx2.lineWidth=2;ctx2.setLineDash([4,3]);ctx2.stroke();ctx2.restore();
            }};
          }

          /* ── 1. LTV pro Kredit — historisch ── */
          chLtv=dst(chLtv);
          var ltvSelEl=g('ch-ltv-sel');
          if(ltvSelEl&&act.length){
            /* Loan selector buttons */
            if(!ltvSelEl.dataset.built){
              ltvSelEl.dataset.built='1';
              ltvSelEl.innerHTML=act.map(function(l,i){
                return '<button class="sm'+(i===0?' on':'')+'" data-li="'+i+'" onclick="window._ltvSel='+i+';d.ch();" style="font-size:11px;padding:2px 8px">'+l.name+'</button>';
              }).join('');
            }
          }
          var selIdx=window._ltvSel||0;
          var ltvC=mk('ch-ltv');
          if(ltvC&&act.length&&act[selIdx]){
            var l=act[selIdx];
            d.fetchBtcHistory(function(hist){
              chLtv=dst(chLtv);
              var pts=[],lbls=[];
              if(hist){
                /* Build daily LTV for past 180 days */
                for(var dd=179;dd>=0;dd--){
                  var dt=new Date();dt.setDate(dt.getDate()-dd);
                  var key=dt.getFullYear()+'-'+String(dt.getMonth()+1).padStart(2,'0')+'-'+String(dt.getDate()).padStart(2,'0');
                  var hp=hist[key];
                  if(hp&&new Date(l.start)<=dt){
                    var dueHist=dueU(l);pts.push(parseFloat((dueHist/(l.col*hp)*100).toFixed(1)));
                    lbls.push(dd===0?'Heute':dt.toLocaleDateString('de-CH',{day:'2-digit',month:'2-digit'}));
                  }
                }
              }
              /* Always add current point */
              if(!pts.length){var dueNow=dueU(l);pts=[parseFloat((dueNow/(l.col*R.BTC)*100).toFixed(1))];lbls=['Heute'];}
              var ptColors=pts.map(function(v){return v>=95?'#dc2626':v>=79?'#ea580c':v>=73?'#d97706':'#16a34a';});
              chLtv=new Chart(ltvC,{type:'line',
                data:{labels:lbls,datasets:[{data:pts,borderColor:'#F97316',backgroundColor:'rgba(249,115,22,.08)',fill:true,tension:0.3,borderWidth:2,pointRadius:0,pointHoverRadius:4,segment:{borderColor:function(ctx){var v=pts[ctx.p1DataIndex];return v>=95?'#dc2626':v>=79?'#ea580c':v>=73?'#d97706':'#16a34a';}}}]},
                options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false},
                  tooltip:{callbacks:{label:function(x){return ' LTV: '+x.parsed.y+'%';}}}},
                  scales:{y:{min:0,max:Math.max(100,Math.ceil(Math.max.apply(null,pts)/10)*10),
                    ticks:{callback:function(v){return v+'%';}},
                    grid:{color:chGridColor}},
                    x:{grid:{display:false},ticks:{maxTicksLimit:8,maxRotation:0,autoSkip:true}}}}});
              /* Add threshold annotation lines manually as datasets */
              /* (no annotation plugin loaded — use reference lines as datasets) */
            });
          }

          /* ── 2. Margin-Call-Distanz ── */
          chMcd=dst(chMcd);
          var mcdC=mk('ch-mcd');
          if(mcdC&&act.length){
            var mcdData=act.map(function(l){
              if(!l.col)return {name:l.name,val:0};
              var mc1Price=(toU(l.amount,l.c)+intU(l))/0.73/l.col;
              var dist=((R.BTC-mc1Price)/R.BTC*100);
              return {name:l.name,val:parseFloat(Math.max(0,dist).toFixed(1))};
            }).sort(function(a,b){return a.val-b.val;});
            var mcdVals=mcdData.map(function(d){return d.val;});
            var mcdLabels=mcdData.map(function(d){return d.name;});
            chMcd=new Chart(mcdC,{type:'bar',
              data:{labels:mcdLabels,
                datasets:[{data:mcdVals,backgroundColor:mcdVals.map(function(v){return v<10?'#dc2626':v<25?'#d97706':'#16a34a';}),borderRadius:4}]},
              options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false},
                tooltip:{callbacks:{label:function(x){return ' '+x.parsed.y+'% Puffer bis MC1';  }}}},
                scales:{y:{min:0,ticks:{callback:function(v){return v+'%';}},grid:{color:chGridColor}},x:{grid:{display:false}}}}});
          }

          /* ── 3. Collateral-Konzentration (Pie) ── */
          chCol=dst(chCol);
          var colC=mk('ch-col');
          if(colC&&act.length){
            var colTotal=act.reduce(function(s,l){return s+l.col;},0);
            chCol=new Chart(colC,{type:'doughnut',
              data:{labels:act.map(function(l){return l.name;}),
                datasets:[{data:act.map(function(l){return l.col;}),backgroundColor:COLORS,borderWidth:2,borderColor:chCardBg}]},
              options:{responsive:true,maintainAspectRatio:false,layout:{padding:{top:30,bottom:30,left:30,right:30}},plugins:{
                legend:{position:'right',labels:{font:{size:11},padding:8,generateLabels:function(chart){
                  return chart.data.labels.map(function(label,i){
                    var val=chart.data.datasets[0].data[i];
                    var pct=colTotal>0?Math.round(val/colTotal*100):0;
                    return{text:label+': '+val.toFixed(4)+' BTC ('+pct+'%)',fillStyle:COLORS[i%COLORS.length],fontColor:chTextColor,hidden:false,index:i};
                  });
                }}},
                tooltip:{callbacks:{label:function(x){
                  var pct=colTotal>0?Math.round(x.parsed/colTotal*100):0;
                  return ' '+x.label+': '+x.parsed.toFixed(8)+' BTC ('+pct+'%)';
                }}},
                datalabels:{anchor:'end',align:'end',offset:6,
                  formatter:function(val,ctx){
                    var pct=colTotal>0?Math.round(val/colTotal*100):0;
                    return val.toFixed(4)+' BTC\n('+pct+'%)';
                  },
                  font:{size:10},color:chText2Color,
                  display:function(ctx){var pct=colTotal>0?ctx.dataset.data[ctx.dataIndex]/colTotal*100:0;return pct>=5;}
                }}},
              plugins:[ChartDataLabels,{id:'colCenter',beforeDraw:function(chart){
                var w=chart.width,h=chart.height,ctx2=chart.ctx;
                ctx2.save();
                var cx=chart.chartArea?(chart.chartArea.left+chart.chartArea.right)/2:w/2;
                var cy=chart.chartArea?(chart.chartArea.top+chart.chartArea.bottom)/2:h/2;
                ctx2.textAlign='center';ctx2.textBaseline='middle';
                ctx2.fillStyle=getComputedStyle(document.getElementById('ffd-root')).getPropertyValue('--text');
                ctx2.font='bold 13px sans-serif';
                ctx2.fillText(colTotal.toFixed(4)+' BTC',cx,cy-8);
                ctx2.font='11px sans-serif';
                ctx2.fillStyle=getComputedStyle(document.getElementById('ffd-root')).getPropertyValue('--text3')||'#888';
                ctx2.fillText('Total',cx,cy+10);
                ctx2.restore();
              }}]});
          }

          /* ── 4. Währungsverteilung (Doughnut) ── */
          chCcy=dst(chCcy);
          var ccyC=mk('ch-ccy');
          if(ccyC&&all.length){
            var ccyMap={};
            all.forEach(function(l){var u=toU(l.amount,l.c);ccyMap[l.c]=(ccyMap[l.c]||0)+u;});
            var ccyKeys=Object.keys(ccyMap);
            var ccyTotal=ccyKeys.reduce(function(s,k){return s+ccyMap[k];},0);
            chCcy=new Chart(ccyC,{type:'doughnut',
              data:{labels:ccyKeys,datasets:[{data:ccyKeys.map(function(k){return Math.round(ccyMap[k]);}),backgroundColor:COLORS,borderWidth:2,borderColor:chCardBg}]},
              options:{responsive:true,maintainAspectRatio:false,layout:{padding:{top:30,bottom:30,left:30,right:30}},plugins:{
                legend:{position:'right',labels:{font:{size:11},padding:8,generateLabels:function(chart){
                  return chart.data.labels.map(function(label,i){
                    var val=ccyMap[label]||0;
                    var pct=ccyTotal>0?Math.round(val/ccyTotal*100):0;
                    return{text:label+': $'+Math.round(val).toLocaleString('de-CH')+' ('+pct+'%)',fillStyle:COLORS[i%COLORS.length],fontColor:chTextColor,hidden:false,index:i};
                  });
                }}},
                tooltip:{callbacks:{label:function(x){
                  var pct=ccyTotal>0?Math.round(x.parsed/ccyTotal*100):0;
                  return ' '+x.label+': $'+x.parsed.toLocaleString('de-CH',{maximumFractionDigits:0})+' ('+pct+'%)';
                }}},
                datalabels:{anchor:'end',align:'end',offset:6,
                  formatter:function(val,ctx){
                    var key=ccyKeys[ctx.dataIndex];
                    var pct=ccyTotal>0?Math.round((ccyMap[key]||0)/ccyTotal*100):0;
                    return key+': $'+Math.round(val).toLocaleString('de-CH')+'\n('+pct+'%)';
                  },
                  font:{size:10},color:chText2Color,
                  display:function(ctx){var pct=ccyTotal>0?ctx.dataset.data[ctx.dataIndex]/ccyTotal*100:0;return pct>=5;}
                }}},
              plugins:[ChartDataLabels,{id:'ccyCenter',beforeDraw:function(chart){
                var w=chart.width,h=chart.height,ctx2=chart.ctx;
                ctx2.save();
                var cx=chart.chartArea?(chart.chartArea.left+chart.chartArea.right)/2:w/2;
                var cy=chart.chartArea?(chart.chartArea.top+chart.chartArea.bottom)/2:h/2;
                ctx2.textAlign='center';ctx2.textBaseline='middle';
                ctx2.fillStyle=getComputedStyle(document.getElementById('ffd-root')).getPropertyValue('--text');
                ctx2.font='bold 13px sans-serif';
                ctx2.fillText('$'+Math.round(ccyTotal).toLocaleString('de-CH'),cx,cy-8);
                ctx2.font='11px sans-serif';
                ctx2.fillStyle=getComputedStyle(document.getElementById('ffd-root')).getPropertyValue('--text3')||'#888';
                ctx2.fillText('Total (USD)',cx,cy+10);
                ctx2.restore();
              }}]});
          }

          /* ── 5. Break-even-Übersicht (horizontal grouped bar) ── */
          chBep=dst(chBep);
          var bepC=mk('ch-bep');
          /* Fetch historic prices for loans missing btcStart, then render */
          (function(){
            var pending=all.filter(function(l){return !l.btcStart&&l.start;});
            var done=0;
            var histPrices={};
            function bsFor(l){return l.btcStart||(l.start&&histPrices[l.start])||R.BTC;}
            function renderBep(){
              if(!bepC||!all.length){
                if(bepC)g('ch-bep').parentElement.innerHTML='<p class="note2" style="text-align:center;padding:2rem">Keine Kredite vorhanden.</p>';
                return;
              }
              chBep=dst(chBep);
              var bepLabels=all.map(function(l){return l.name+(!l.btcStart?' *':'');});
              var startVals=all.map(function(l){return bsFor(l);});
              var bepVals=all.map(function(l){
                var lU=toU(l.amount,l.c);var bs=bsFor(l);
                return parseFloat((bs*(dueU(l)/lU)).toFixed(0));
              });
              chBep=new Chart(bepC,{type:'bar',
                data:{labels:bepLabels,
                  datasets:[
                    {label:'BTC bei Aufnahme',data:startVals,backgroundColor:'rgba(59,130,246,.6)',borderColor:'#3B82F6',borderWidth:1,borderRadius:4},
                    {label:'Break-even BTC',data:bepVals,backgroundColor:'rgba(249,115,22,.6)',borderColor:'#F97316',borderWidth:1,borderRadius:4}
                  ]},
                options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{position:'top',labels:{font:{size:11}}},
                  tooltip:{callbacks:{label:function(x){return ' '+x.dataset.label+': $'+x.parsed.y.toLocaleString('de-CH',{maximumFractionDigits:0});}}}},
                  scales:{y:{ticks:{callback:function(v){return '$'+Math.round(v/1000)+'k';}},grid:{color:chGridColor}},x:{grid:{display:false}}},
                  annotation:{annotations:{cur:{type:'line',yMin:R.BTC,yMax:R.BTC,borderColor:'#16a34a',borderWidth:2,borderDash:[6,3],label:{content:'Aktuell $'+Math.round(R.BTC/1000)+'k',display:true,position:'end',font:{size:10}}}}}}});
            }
            if(!pending.length){renderBep();return;}
            /* Temporäre Map für historische Preise — btcStart am Loan-Objekt bleibt unverändert */
            var histPrices={};
            pending.forEach(function(l){
              d.btcHistPrice(l.start,function(usd){
                if(usd)histPrices[l.start]=usd;
                done++;
                if(done===pending.length)renderBep();
              });
            });
          })();

          /* ── 6. Zinskosten gesamt vs. aufgelaufen (zeitanteilig als Indikator) ── */
          /* Bei Firefish: keine Teilrueckzahlungen — alles wird am Ende faellig.        */
          chInt2=dst(chInt2);
          var intC=mk('ch-int');
          if(intC&&act.length){
            var nowI=new Date();
            var totalInt=act.map(function(l){return parseFloat(intU(l).toFixed(0));});
            var totalFee=act.map(function(l){return parseFloat(feeU(l).toFixed(0));});
            var accruedInt=act.map(function(l){
              var pct=Math.min(1,Math.max(0,(nowI-new Date(l.start))/(l.term*30*864e5)));
              return parseFloat((intU(l)*pct).toFixed(0));
            });
            chInt2=new Chart(intC,{type:'bar',
              data:{labels:act.map(function(l){return l.name;}),
                datasets:[
                  {label:'Gesamtzinsen (fällig am Ende)',data:totalInt,backgroundColor:'rgba(249,115,22,.25)',borderColor:'#F97316',borderWidth:1,borderRadius:4},
                  {label:'Davon bisher aufgelaufen',data:accruedInt,backgroundColor:'rgba(249,115,22,.7)',borderColor:'#F97316',borderWidth:1,borderRadius:4},
                  {label:'Gebühren (einmalig)',data:totalFee,backgroundColor:'rgba(139,92,246,.4)',borderColor:'#8B5CF6',borderWidth:1,borderRadius:4}
                ]},
              options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{position:'top',labels:{font:{size:11}}},
                tooltip:{callbacks:{label:function(x){return ' '+x.dataset.label+': $'+x.parsed.y.toLocaleString('de-CH',{maximumFractionDigits:0});}}}},
                scales:{x:{grid:{display:false}},y:{ticks:{callback:function(v){return '$'+Math.round(v);}},grid:{color:chGridColor}}}}});
          }

          /* ── 7b. Monatliche Zinslast über Zeit ── */
          chZinslast=dst(chZinslast);
          var zinslastC=mk('ch-zinslast');
          if(zinslastC&&act.length){
            /* Build months axis: from earliest start to latest maturity + 2 months */
            var now_zl=new Date();
            var earliest=new Date(Math.min.apply(null,act.map(function(l){return new Date(l.start);})));
            var latest=new Date(Math.max.apply(null,act.map(function(l){return aM(l.start,l.term);})));
            var startM=new Date(now_zl.getFullYear(),now_zl.getMonth(),1);
            var endM=new Date(latest.getFullYear(),latest.getMonth()+2,1);
            var months=[];
            var cur=new Date(startM);
            while(cur<=endM){months.push(new Date(cur));cur.setMonth(cur.getMonth()+1);}
            var zlLabels=months.map(function(m){return m.toLocaleDateString('de-CH',{month:'short',year:'2-digit'});});
            /* Per-loan monthly interest: spread total interest evenly over loan months */
            var zlDatasets=act.map(function(l,i){
              var lStart=new Date(l.start);
              var lEnd=aM(l.start,l.term);
              var monthlyInt=toU(l.amount*(l.rate/100)/12,l.c);
              var data=months.map(function(m){
                var mEnd=new Date(m.getFullYear(),m.getMonth()+1,0);
                /* Loan active this month? */
                if(m>=lEnd||mEnd<lStart)return 0;
                return parseFloat(monthlyInt.toFixed(2));
              });
              return {
                label:l.name,
                data:data,
                backgroundColor:COLORS[i%COLORS.length].replace(')',', 0.7)').replace('rgb','rgba').replace('#','').length>7?COLORS[i%COLORS.length]+'b3':COLORS[i%COLORS.length],
                borderColor:COLORS[i%COLORS.length],
                borderWidth:1,
                fill:true
              };
            });
            /* Fix backgroundColor — use simple rgba from hex */
            zlDatasets.forEach(function(ds,i){
              var hex=COLORS[i%COLORS.length];
              var r=parseInt(hex.slice(1,3),16),gv=parseInt(hex.slice(3,5),16),b=parseInt(hex.slice(5,7),16);
              ds.backgroundColor='rgba('+r+','+gv+','+b+',0.65)';
              ds.borderColor=hex;
            });
            var zlTodayPlugin=makeTodayPlugin(zlLabels);
            chZinslast=new Chart(zinslastC,{
              type:'bar',
              data:{labels:zlLabels,datasets:zlDatasets},
              options:{
                responsive:true,maintainAspectRatio:false,
                interaction:{mode:'index',intersect:false},
                plugins:{
                  legend:{position:'top',labels:{font:{size:11}}},
                  tooltip:{callbacks:{
                    label:function(x){return ' '+x.dataset.label+': $'+x.parsed.y.toLocaleString('de-CH',{maximumFractionDigits:0});},
                    footer:function(items){var sum=items.reduce(function(s,x){return s+x.parsed.y;},0);return sum>0?'Gesamt: $'+Math.round(sum).toLocaleString('de-CH'):'';} 
                  }}
                },
                scales:{
                  x:{stacked:true,grid:{display:false},ticks:{maxTicksLimit:18,autoSkip:true}},
                  y:{stacked:true,ticks:{callback:function(v){return '$'+Math.round(v);}},grid:{color:chGridColor}}
                }
              },
              plugins:[zlTodayPlugin]
            });
          }

          /* ── 7. Effektivkosten in BTC ── */
          (function(){
            chBtcost=dst(chBtcost);
            var btcostC=mk('ch-btcost');
            if(!btcostC)return;
            if(!all.length){btcostC.parentElement.innerHTML='<p class="note2" style="text-align:center;padding:2rem">Keine Kredite vorhanden.</p>';return;}
            var btcostLoans=all;
            var btcostPrices={};
            var pending=btcostLoans.filter(function(l){return !l.btcStart&&l.start;});
            function renderBtcost(){
              var btcCosts=btcostLoans.map(function(l){
                var totalCostUSD=intU(l)+feeU(l);
                var bs=l.btcStart||(l.start&&btcostPrices[l.start])||R.BTC;
                return parseFloat((totalCostUSD/bs).toFixed(8));
              });
              chBtcost=new Chart(btcostC,{type:'bar',
                data:{labels:btcostLoans.map(function(l){return l.name;}),
                  datasets:[{data:btcCosts,backgroundColor:'rgba(139,92,246,.6)',borderColor:'#8B5CF6',borderWidth:1,borderRadius:4}]},
                options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false},
                  tooltip:{callbacks:{label:function(x){return ' '+x.parsed.y+' BTC Gesamtkosten (Zins+Geb\xfchr)';}}}},
                  scales:{y:{ticks:{callback:function(v){return v+' \u20bf';}},grid:{color:chGridColor}},x:{grid:{display:false}}}}});
            }
            if(!pending.length){renderBtcost();return;}
            var done=0;
            pending.forEach(function(l){
              d.btcHistPrice(l.start,function(usd){
                if(usd)btcostPrices[l.start]=usd;
                done++;
                if(done===pending.length)renderBtcost();
              });
            });
          })();

          /* ── 8. Fälligkeits-Gantt ── */
          var ganttEl=g('ch-gantt');
          if(ganttEl&&all.length){
            var ganttLoans=all.slice().sort(function(a,b){return new Date(a.start)-new Date(b.start);});
            var now=new Date();
            var minD=new Date(Math.min.apply(null,ganttLoans.map(function(l){return new Date(l.start);})));
            var latestDueG=new Date(Math.max.apply(null,ganttLoans.map(function(l){return aM(l.start,l.term);})));
            var maxD=new Date(latestDueG.getFullYear(),latestDueG.getMonth()+2,1);
            var total=maxD-minD||1;
            /* Build X-axis ticks & gridlines */
            var xTicks=(function(){
              var totalMonths=Math.round((maxD-minD)/(1000*60*60*24*30.44));
              var step=totalMonths<=6?1:totalMonths<=12?1:totalMonths<=24?2:totalMonths<=48?3:6;
              var ticks=[],lines=[];
              var cur=new Date(Date.UTC(minD.getUTCFullYear(),minD.getUTCMonth(),1));
              while(cur<=new Date(maxD.getTime()+1)){
                var pct=Math.max(0,Math.min(100,((cur-minD)/total*100))).toFixed(2);
                var lbl=cur.toLocaleDateString('de-CH',{month:'short',year:'2-digit'});
                ticks.push('<div style="position:absolute;left:'+pct+'%;transform:translateX(-50%);font-size:9px;color:var(--text4);white-space:nowrap">'+lbl+'</div>');
                lines.push('<div style="position:absolute;left:'+pct+'%;top:0;width:1px;height:100%;background:var(--border);opacity:.4;pointer-events:none"></div>');
                cur=new Date(Date.UTC(cur.getUTCFullYear(),cur.getUTCMonth()+step,1));
              }
              return {ticks:ticks.join(''),lines:lines.join('')};
            })();
            var nowPctG=Math.min(100,Math.max(0,((now-minD)/total*100))).toFixed(1);
            ganttEl.innerHTML=
              '<div style="display:flex;align-items:flex-end;gap:8px;margin-bottom:3px">'+
                '<div style="width:90px;flex-shrink:0"></div>'+
                '<div style="flex:1;position:relative;height:16px">'+xTicks.ticks+'</div>'+
                '<div style="width:70px;flex-shrink:0;font-size:10px;font-weight:600;color:var(--text4);text-align:right">F&#228;lligkeit</div>'+
              '</div>'+
              '<div style="padding:.25rem 0">'+
              ganttLoans.map(function(l){
                var s=new Date(l.start),e=aM(l.start,l.term);
                var left=((s-minD)/total*100).toFixed(1);
                var width=Math.max(((e-s)/total*100).toFixed(1),1);
                var clr=l.status==='closed'?'#9ca3af':l.col>0&&((dueU(l))/(l.col*R.BTC))>=0.73?'#ea580c':'#F97316';
                return '<div style="display:flex;align-items:center;gap:8px;margin-bottom:5px">'+
                  '<div style="width:90px;flex-shrink:0;font-size:11px;font-weight:600;color:var(--text2);white-space:nowrap;overflow:hidden;text-overflow:ellipsis">'+l.name+'</div>'+
                  '<div style="flex:1;position:relative;height:22px;background:var(--bg3);border-radius:4px;overflow:hidden">'+
                    xTicks.lines+
                    '<div style="position:absolute;left:'+left+'%;width:'+width+'%;height:100%;background:'+clr+';border-radius:4px;opacity:'+(l.status==='closed'?.5:1)+';display:flex;align-items:center;padding:0 6px;overflow:hidden;z-index:1">'+
                      '<span style="font-size:10px;color:#fff;white-space:nowrap">'+fmt(l.amount,l.c)+'</span>'+
                    '</div>'+
                    '<div style="position:absolute;left:'+nowPctG+'%;top:0;width:2px;height:100%;background:#ef4444;border-radius:1px;z-index:2"></div>'+
                  '</div>'+
                  '<div style="width:70px;flex-shrink:0;font-size:10px;color:var(--text4);text-align:right">'+e.toLocaleDateString('de-CH',{month:'2-digit',year:'2-digit'})+'</div>'+
                '</div>';
              }).join('')+
              '</div>'+
              '<div style="font-size:10px;color:var(--text4);margin-top:4px">&#9632; Roter Strich = Heute</div>';
          }

          /* ── Roll-Over-Timeline ── */
          var roTlEl=g('ch-ro-timeline');
          if(roTlEl){
            var chains={};
            all.forEach(function(l){if(l.chainId)chains[l.chainId]=(chains[l.chainId]||[]).concat(l);});
            var chainIds=Object.keys(chains);
            if(!chainIds.length){
              roTlEl.innerHTML='<p class="note2" style="text-align:center;padding:1.5rem">Keine Roll-Over-Ketten vorhanden.</p>';
            } else {
              /* Sort each chain by start date */
              chainIds.forEach(function(cid){chains[cid].sort(function(a,b){return new Date(a.start)-new Date(b.start);});});
              /* Timeline range */
              var allChainLoans=chainIds.reduce(function(a,cid){return a.concat(chains[cid]);},[]); 
              var minDR=new Date(Math.min.apply(null,allChainLoans.map(function(l){return new Date(l.start);})));
              var latestDueR=new Date(Math.max.apply(null,allChainLoans.map(function(l){return aM(l.start,l.term);})));
              var maxDR=new Date(latestDueR.getFullYear(),latestDueR.getMonth()+2,1);
              var totalR=maxDR-minDR||1;
              var nowR=new Date();
              var nowPctR=Math.min(100,Math.max(0,((nowR-minDR)/totalR*100))).toFixed(1);
              /* X-axis ticks */
              var totalMonthsR=Math.round((maxDR-minDR)/(1000*60*60*24*30.44));
              var stepR=totalMonthsR<=12?1:totalMonthsR<=24?2:totalMonthsR<=48?3:6;
              var ticksR='',linesR='';
              var curR=new Date(Date.UTC(minDR.getUTCFullYear(),minDR.getUTCMonth(),1));
              while(curR<=new Date(maxDR.getTime()+1)){
                var pctR=Math.max(0,Math.min(100,((curR-minDR)/totalR*100))).toFixed(2);
                ticksR+='<div style="position:absolute;left:'+pctR+'%;transform:translateX(-50%);font-size:9px;color:var(--text4);white-space:nowrap">'+curR.toLocaleDateString('de-CH',{month:'short',year:'2-digit'})+'</div>';
                linesR+='<div style="position:absolute;left:'+pctR+'%;top:0;width:1px;height:100%;background:var(--border);opacity:.4;pointer-events:none"></div>';
                curR=new Date(Date.UTC(curR.getUTCFullYear(),curR.getUTCMonth()+stepR,1));
              }
              var CHAIN_COLORS=['#F97316','#3B82F6','#10B981','#8B5CF6','#EF4444','#F59E0B','#06B6D4','#EC4899'];
              var html=
                '<div style="display:flex;align-items:flex-end;gap:8px;margin-bottom:3px">'+
                  '<div style="width:110px;flex-shrink:0"></div>'+
                  '<div style="flex:1;position:relative;height:16px">'+ticksR+'</div>'+
                  '<div style="width:80px;flex-shrink:0;font-size:10px;font-weight:600;color:var(--text4);text-align:right">Kosten</div>'+
                '</div>'+
                '<div style="padding:.25rem 0">';
              chainIds.forEach(function(cid,ci){
                var clr=CHAIN_COLORS[ci%CHAIN_COLORS.length];
                var chainLoans=chains[cid];
                var chainName=chainLoans[0].name.replace(/v\d+$/,'').trim()||'Kette '+(ci+1);
                var totalCost=chainLoans.reduce(function(s,l){return s+intU(l)+feeU(l);},0);
                html+='<div style="display:flex;align-items:center;gap:8px;margin-bottom:6px">'+
                  '<div style="width:110px;flex-shrink:0;font-size:11px;font-weight:700;color:'+clr+';white-space:nowrap;overflow:hidden;text-overflow:ellipsis" title="'+chainLoans.length+' Kredite">🔗 '+chainName+'</div>'+
                  '<div style="flex:1;position:relative;height:26px;background:var(--bg3);border-radius:6px;overflow:hidden">'+
                    linesR;
                chainLoans.forEach(function(l,li){
                  var s=new Date(l.start),e=aM(l.start,l.term);
                  var left=((s-minDR)/totalR*100).toFixed(1);
                  var width=Math.max(((e-s)/totalR*100).toFixed(1),0.5);
                  var isActive=l.status==='active';
                  var intCost=intU(l);
                  var gap=li>0?2:0;
                  html+='<div title="'+l.name+' · '+fmt(l.amount,l.c)+' · Zinsen: '+fmt(intCost,'USD')+'" style="position:absolute;left:calc('+left+'% + '+gap+'px);width:calc('+width+'% - '+gap+'px);height:100%;background:'+clr+';opacity:'+(isActive?1:.55)+';border-radius:3px;display:flex;align-items:center;overflow:hidden;padding:0 4px;z-index:1;box-sizing:border-box">'+
                    '<span style="font-size:9px;color:#fff;white-space:nowrap;overflow:hidden">'+l.name+'</span>'+
                  '</div>';
                });
                html+='<div style="position:absolute;left:'+nowPctR+'%;top:0;width:2px;height:100%;background:#ef4444;z-index:2"></div>'+
                  '</div>'+
                  '<div style="width:80px;flex-shrink:0;font-size:10px;font-weight:600;color:var(--text3);text-align:right">'+fmt(totalCost,'USD')+'</div>'+
                '</div>';
              });
              html+='</div><div style="font-size:10px;color:var(--text4);margin-top:4px">■ Roter Strich = Heute &nbsp;·&nbsp; Gestapfte Balken = einzelne Roll-Overs &nbsp;·&nbsp; Transparenz = abgeschlossen</div>';
              roTlEl.innerHTML=html;
            }
          }

          /* ── 9. Cashflow-Vorschau (nächste 12 Monate) ── */
          chCf=dst(chCf);
          var cfC=mk('ch-cf');
          if(cfC){
            var now2=new Date();
            var cfLatest=act.length?new Date(Math.max.apply(null,act.map(function(l){return aM(l.start,l.term);}))):new Date(now2.getFullYear(),now2.getMonth()+12,1);
            var cfMax=new Date(cfLatest.getFullYear(),cfLatest.getMonth()+2,1);
            var cfMonths=[],cfLabels=[];
            var cfCur=new Date(now2.getFullYear(),now2.getMonth()+1,1);
            while(cfCur<=cfMax){
              cfMonths.push(new Date(cfCur));cfLabels.push(cfCur.toLocaleDateString('de-CH',{month:'short',year:'2-digit'}));
              cfCur.setMonth(cfCur.getMonth()+1);
            }
            var cfData=cfMonths.map(function(m){
              return act.reduce(function(sum,l){
                var end=aM(l.start,l.term);
                /* Does this loan end in month m? */
                if(end.getFullYear()===m.getFullYear()&&end.getMonth()===m.getMonth()){
                  return sum+dueU(l);
                }
                return sum;
              },0);
            });
            chCf=new Chart(cfC,{type:'bar',
              data:{labels:cfLabels,datasets:[{data:cfData,backgroundColor:cfData.map(function(v){return v>0?'rgba(249,115,22,.7)':'rgba(229,231,235,.5)';}),borderColor:cfData.map(function(v){return v>0?'#F97316':'#e5e7eb';}),borderWidth:1,borderRadius:4}]},
              options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false},
                tooltip:{callbacks:{label:function(x){return x.parsed.y>0?' Fällig (Kapital+Zinsen): $'+x.parsed.y.toLocaleString('de-CH',{maximumFractionDigits:0}):'  Nichts fällig';}}}},
                scales:{y:{ticks:{callback:function(v){return v>0?'$'+Math.round(v/1000)+'k':'';}},grid:{color:chGridColor}},x:{grid:{display:false}}}},
              plugins:[makeTodayPlugin(cfLabels)]});
          }

          /* ── 10. Schulden vs. Collateral-Wert ── */
          chDcol=dst(chDcol);
          var dcolC=mk('ch-dcol');
          if(dcolC){
            (function(){
              var now3=new Date();
              /* Alle Kredite (aktiv + abgeschlossen) für historischen Verlauf */
              var dcolLoans=loans;
              var oldest3=dcolLoans.reduce(function(e,l){var s=new Date(l.start);return s<e?s:e;},now3);
              var dcStart=new Date(oldest3.getFullYear(),oldest3.getMonth(),1);
              var dcLatest=dcolLoans.length?new Date(Math.max.apply(null,dcolLoans.map(function(l){return aM(l.start,l.term);}))):now3;
              var dcEnd=new Date(dcLatest.getFullYear(),dcLatest.getMonth()+2,1);

              /* Alle Monatsdaten sammeln (1. des Monats) */
              var months=[];
              for(var mm=new Date(dcStart);mm<=dcEnd;mm=new Date(mm.getFullYear(),mm.getMonth()+1,1)){
                months.push(new Date(mm));
              }

              /* Für vergangene Monate historischen BTC-Preis laden */
              var firstOfThisMonth=new Date(now3.getFullYear(),now3.getMonth(),1);
              var pastMonths=months.filter(function(m){return m<firstOfThisMonth;});
              var histMap={}; /* ISO-Date → USD */
              var pending=pastMonths.length;

              function renderDcol(){
                var dcLabels=[],dcDebt=[],dcCol=[],dcDebtBtc=[];
                months.forEach(function(m,mi){
                  var iso=m.getFullYear()+'-'+String(m.getMonth()+1).padStart(2,'0')+'-01';
                  var btcPrice=(m<firstOfThisMonth)?(histMap[iso]||R.BTC):R.BTC;
                  dcLabels.push(m.toLocaleDateString('de-CH',{month:'short',year:'2-digit'}));
                  var debt=dcolLoans.reduce(function(s,l){
                    var lStart=new Date(l.start);
                    var lEnd=aM(l.start,l.term);
                    var active=m>=new Date(lStart.getFullYear(),lStart.getMonth(),1)&&m<=lEnd;
                    if(!active)return s;
                    if(l.status==='closed'&&m>=firstOfThisMonth)return s;
                    return s+toU(l.amount,l.c)+intU(l);
                  },0);
                  var col=dcolLoans.reduce(function(s,l){
                    var lStart=new Date(l.start);
                    var lEnd=aM(l.start,l.term);
                    var active=m>=new Date(lStart.getFullYear(),lStart.getMonth(),1)&&m<=lEnd;
                    if(!active)return s;
                    if(l.status==='closed'&&m>=firstOfThisMonth)return s;
                    return s+l.col*btcPrice;
                  },0);
                  dcDebt.push(debt);
                  dcCol.push(col);
                  dcDebtBtc.push(btcPrice>0?parseFloat((debt/btcPrice).toFixed(6)):0);
                });
                chDcol=dst(chDcol);
                chDcol=new Chart(dcolC,{type:'line',
                  data:{labels:dcLabels,datasets:[
                    {label:'Schulden (USD)',data:dcDebt,borderColor:'#EF4444',backgroundColor:'rgba(239,68,68,.1)',fill:true,tension:0.3,borderWidth:2,pointRadius:3,yAxisID:'y'},
                    {label:'Collateral-Wert (USD)',data:dcCol,borderColor:'#10B981',backgroundColor:'rgba(16,185,129,.08)',fill:true,tension:0.3,borderWidth:2,pointRadius:3,yAxisID:'y'},
                    {label:'Schulden (BTC)',data:dcDebtBtc,borderColor:'#F59E0B',backgroundColor:'transparent',fill:false,tension:0.3,borderWidth:2,pointRadius:3,borderDash:[5,3],yAxisID:'yBtc'}
                  ]},
                  options:{responsive:true,maintainAspectRatio:false,
                    interaction:{mode:'index',intersect:false},
                    plugins:{legend:{position:'top',labels:{font:{size:11}}},
                      tooltip:{callbacks:{label:function(x){
                        if(x.dataset.yAxisID==='yBtc')return ' '+x.dataset.label+': '+x.parsed.y.toFixed(6)+' BTC';
                        return ' '+x.dataset.label+': $'+x.parsed.y.toLocaleString('de-CH',{maximumFractionDigits:0});
                      }}}},
                    scales:{
                      y:{position:'left',ticks:{callback:function(v){return '$'+Math.round(v/1000)+'k';}},grid:{color:chGridColor}},
                      yBtc:{position:'right',ticks:{callback:function(v){return v.toFixed(4)+'₿';}},grid:{display:false},title:{display:true,text:'BTC',font:{size:10}}},
                      x:{grid:{display:false}}}},
                  plugins:[makeTodayPlugin(dcLabels)]});
              }

              if(!pending){renderDcol();return;}

              /* Historische Preise parallel laden, dann rendern */
              pastMonths.forEach(function(m){
                var iso=m.getFullYear()+'-'+String(m.getMonth()+1).padStart(2,'0')+'-01';
                d.btcHistPrice(iso,function(usd){
                  if(usd)histMap[iso]=usd;
                  pending--;
                  if(pending===0)renderDcol();
                });
              });
            })();
          }

          /* ── 11. Laufzeitverteilung ── */
          chTerm=dst(chTerm);
          var termC=mk('ch-term');
          if(termC&&act.length){
            var now4=new Date();
            var buckets=[
              {label:'Überfällig',min:-Infinity,max:0,count:0,vol:0},
              {label:'< 1 Monat',min:0,max:30,count:0,vol:0},
              {label:'1–3 Monate',min:30,max:90,count:0,vol:0},
              {label:'3–6 Monate',min:90,max:180,count:0,vol:0},
              {label:'6–12 Monate',min:180,max:365,count:0,vol:0},
              {label:'> 12 Monate',min:365,max:Infinity,count:0,vol:0}
            ];
            act.forEach(function(l){
              var days=dL(l.start,l.term);
              var b=buckets.find(function(b){return days>b.min&&days<=b.max;});
              if(!b)b=buckets[buckets.length-1];
              b.count++;
              b.vol+=toU(l.amount,l.c);
            });
            var active=buckets.filter(function(b){return b.count>0;});
            var colors=['#dc2626','#ea580c','#d97706','#F97316','#16a34a','#0ea5e9'];
            var bColors=buckets.map(function(b,i){
              if(b.label==='Überfällig')return '#dc2626';
              if(b.label==='< 1 Monat')return '#ea580c';
              if(b.label==='1–3 Monate')return '#d97706';
              if(b.label==='3–6 Monate')return '#F97316';
              if(b.label==='6–12 Monate')return '#16a34a';
              return '#0ea5e9';
            });
            chTerm=new Chart(termC,{type:'bar',
              data:{
                labels:buckets.map(function(b){return b.label;}),
                datasets:[
                  {label:'Anzahl Kredite',data:buckets.map(function(b){return b.count;}),
                   backgroundColor:bColors.map(function(c){return c+'99';}),
                   borderColor:bColors,borderWidth:1,borderRadius:4,yAxisID:'y'},
                  {label:'Volumen (USD)',data:buckets.map(function(b){return b.vol;}),
                   backgroundColor:'rgba(99,102,241,.15)',borderColor:'#6366f1',
                   borderWidth:1,borderRadius:4,type:'bar',yAxisID:'yVol'}
                ]
              },
              options:{responsive:true,maintainAspectRatio:false,
                plugins:{legend:{position:'top',labels:{font:{size:11}}},
                  tooltip:{callbacks:{label:function(x){
                    if(x.dataset.yAxisID==='yVol')return ' Volumen: $'+Math.round(x.parsed.y).toLocaleString('de-CH');
                    return ' Kredite: '+x.parsed.y;
                  }}}},
                scales:{
                  y:{position:'left',title:{display:true,text:'Anzahl',font:{size:10}},ticks:{stepSize:1},grid:{color:chGridColor}},
                  yVol:{position:'right',title:{display:true,text:'Volumen USD',font:{size:10}},ticks:{callback:function(v){return '$'+Math.round(v/1000)+'k';}},grid:{display:false}},
                  x:{grid:{display:false}}
                }
              }
            });
          }

        },80);
      },
      /* ─── Dark mode ─── */
      toggleDark:function(){
        var r=document.getElementById('ffd-root');
        var isDark=r.classList.toggle('dark');
        localStorage.setItem('ffd_dark',isDark?'1':'');
        g('dark-btn').textContent=isDark?'☀':'☾';
      },

      toggleHideAmounts:function(){
        var r=document.getElementById('ffd-root');
        var hidden=r.classList.toggle('hide-amounts');
        cfg.hideAmounts=hidden;
        saveSettings(cfg);
      },

      /* ─── Sidebar collapse ─── */
      toggleSidebar:function(){
        var sb=document.querySelector('#ffd-root .sidebar');
        var mn=document.querySelector('#ffd-root .main');
        var collapsed=sb.classList.toggle('collapsed');
        if(collapsed){mn.classList.add('sidebar-collapsed');mn.style.marginLeft='52px';}
        else{mn.classList.remove('sidebar-collapsed');mn.style.marginLeft='200px';}
        localStorage.setItem('ffd_sidebar_collapsed',collapsed?'1':'');
      },

      /* ─── Alarm banner ─── */
      checkAlarms:function(){
        var act=loans.filter(function(l){return l.status==='active';});
        var liqd=act.filter(function(l){var ltv=(toU(l.amount,l.c)+intU(l))/(l.col*R.BTC);return l.col>0&&ltv>=0.95;});
        var danger=act.filter(function(l){var ltv=(toU(l.amount,l.c)+intU(l))/(l.col*R.BTC);return l.col>0&&ltv>=(cfg.ltvDanger!=null?cfg.ltvDanger/100:0.86)&&ltv<0.95;});
        var crit=act.filter(function(l){var ltv=(toU(l.amount,l.c)+intU(l))/(l.col*R.BTC);return l.col>0&&ltv>=(cfg.ltvCrit/100)&&ltv<(cfg.ltvDanger!=null?cfg.ltvDanger/100:0.86);});
        var warn=act.filter(function(l){var ltv=(toU(l.amount,l.c)+intU(l))/(l.col*R.BTC);return l.col>0&&ltv>=(cfg.ltvWarn/100)&&ltv<(cfg.ltvCrit/100);});
        var el=g('alarm-banner');if(!el)return;
        if(liqd.length){
          el.className='alarm-banner crit show';
          el.innerHTML='&#128308; LIQUIDIERT: '+liqd.map(function(l){var due=toU(l.amount,l.c)+intU(l);return l.name+' LTV '+(due/(l.col*R.BTC)*100).toFixed(1)+'%';}).join(' · ')+' — Kredit wurde liquidiert!';
        } else if(danger.length){
          el.className='alarm-banner crit show';
          el.innerHTML='&#128308; GEFAHR MC3: '+danger.map(function(l){var due=toU(l.amount,l.c)+intU(l);return l.name+' LTV '+(due/(l.col*R.BTC)*100).toFixed(1)+'%';}).join(' · ')+' — Liquidationsgefahr!';
        } else if(crit.length){
          el.className='alarm-banner crit show';
          el.innerHTML='&#9888; KRITISCH MC2: '+crit.map(function(l){var due=toU(l.amount,l.c)+intU(l);return l.name+' LTV '+(due/(l.col*R.BTC)*100).toFixed(1)+'%';}).join(' · ')+' — Margin Call!';
        } else if(warn.length){
          el.className='alarm-banner warn show';
          el.innerHTML='&#9888; Warnung MC1: '+warn.map(function(l){var due=toU(l.amount,l.c)+intU(l);return l.name+' LTV '+(due/(l.col*R.BTC)*100).toFixed(1)+'%';}).join(' · ')+' — LTV \u00fcber '+cfg.ltvWarn+'%';
        } else {
          el.className='alarm-banner';el.innerHTML='';
        }
        d.renderNextAction();
      },

      renderNextAction:function(){
        var el=g('next-action-widget');if(!el)return;
        var act=loans.filter(function(l){return l.status==='active';});
        if(!act.length){el.innerHTML='';return;}

        /* Priority 1 — liquidated (LTV >= 95%) */
        var liqd=act.filter(function(l){var ltv=l.col>0?(toU(l.amount,l.c)+intU(l))/(l.col*R.BTC):0;return ltv>=0.95;});
        if(liqd.length){
          var l=liqd[0];var ltv=((toU(l.amount,l.c)+intU(l))/(l.col*R.BTC)*100).toFixed(1);
          el.innerHTML=d._naCard('🔴','Kredit liquidiert','Der Kredit wurde durch Firefish liquidiert','<b>'+l.name+'</b> hat LTV '+ltv+'% — Liquidation erfolgt!','#dc2626','rgba(220,38,38,.08)');return;
        }
        /* Priority 2 — danger LTV */
        var danger=act.filter(function(l){var ltv=l.col>0?(toU(l.amount,l.c)+intU(l))/(l.col*R.BTC):0;return ltv>=(cfg.ltvDanger!=null?cfg.ltvDanger/100:0.86)&&ltv<0.95;});
        if(danger.length){
          var l=danger[0];var ltv=((toU(l.amount,l.c)+intU(l))/(l.col*R.BTC)*100).toFixed(1);
          el.innerHTML=d._naCard('🔴','Sofortiger Handlungsbedarf','Collateral nachschiessen oder Kredit zurückzahlen','<b>'+l.name+'</b> hat LTV '+ltv+'% — Liquidationsgefahr!','#dc2626','rgba(220,38,38,.08)');return;
        }
        /* Priority 3 — crit LTV */
        var crit=act.filter(function(l){var ltv=l.col>0?(toU(l.amount,l.c)+intU(l))/(l.col*R.BTC):0;return ltv>=(cfg.ltvCrit/100)&&ltv<(cfg.ltvDanger!=null?cfg.ltvDanger/100:0.86);});
        if(crit.length){
          var l=crit[0];var ltv=((toU(l.amount,l.c)+intU(l))/(l.col*R.BTC)*100).toFixed(1);
          el.innerHTML=d._naCard('🟠','Margin Call Warnung','LTV kritisch — Collateral prüfen','<b>'+l.name+'</b> hat LTV '+ltv+'% — MC2 erreicht','#ea580c','rgba(234,88,12,.07)');return;
        }
        /* Priority 3 — due within 7 days */
        var urgent=act.filter(function(l){var d2=dL(l.start,l.term);return d2>=0&&d2<=7;}).sort(function(a,b){return dL(a.start,a.term)-dL(b.start,b.term);});
        if(urgent.length){
          var l=urgent[0];var dl=dL(l.start,l.term);
          el.innerHTML=d._naCard('⏰','Kredit läuft ab','Roll-Over vorbereiten oder zurückzahlen','<b>'+l.name+'</b> — fällig in <b>'+dl+' Tag'+(dl===1?'':'en')+'</b> ('+fmt(frU(dueU(l),l.c),l.c)+')','#d97706','rgba(217,119,6,.07)');return;
        }
        /* Priority 4 — due within 30 days */
        var soon=act.filter(function(l){var d2=dL(l.start,l.term);return d2>=0&&d2<=30;}).sort(function(a,b){return dL(a.start,a.term)-dL(b.start,b.term);});
        if(soon.length){
          var l=soon[0];var dl=dL(l.start,l.term);
          el.innerHTML=d._naCard('📅','Fälligkeit in Kürze','Roll-Over oder Rückzahlung planen','<b>'+l.name+'</b> — fällig in <b>'+dl+' Tagen</b> ('+aM(l.start,l.term).toLocaleDateString('de-CH',{day:'2-digit',month:'short',year:'numeric'})+')','#6366f1','rgba(99,102,241,.06)');return;
        }
        /* Priority 5 — warn LTV */
        var warn=act.filter(function(l){var ltv=l.col>0?(toU(l.amount,l.c)+intU(l))/(l.col*R.BTC):0;return ltv>=(cfg.ltvWarn/100)&&ltv<(cfg.ltvCrit/100);});
        if(warn.length){
          var l=warn[0];var ltv=((toU(l.amount,l.c)+intU(l))/(l.col*R.BTC)*100).toFixed(1);
          el.innerHTML=d._naCard('🟡','LTV im Beobachtungsbereich','BTC-Preisentwicklung im Auge behalten','<b>'+l.name+'</b> hat LTV '+ltv+'% — über MC1-Schwelle','#d97706','rgba(217,119,6,.06)');return;
        }
        /* All good */
        var next=act.slice().sort(function(a,b){return dL(a.start,a.term)-dL(b.start,b.term);})[0];
        var dl=dL(next.start,next.term);
        el.innerHTML=d._naCard('✅','Alles im grünen Bereich','Nächste Fälligkeit: <b>'+next.name+'</b> in '+dl+' Tagen','Portfolio-LTV und Margin Call-Distanzen sind unkritisch','#16a34a','rgba(22,163,74,.06)');
      },
      _naCard:function(icon,title,action,detail,color,bg){
        return '<div style="display:flex;align-items:center;gap:.85rem;padding:.7rem 1rem;background:'+bg+';border:1px solid '+color+';border-radius:10px;border-left:4px solid '+color+'">'+
          '<span style="font-size:22px;line-height:1">'+icon+'</span>'+
          '<div style="flex:1;min-width:0">'+
            '<div style="font-size:13px;font-weight:700;color:'+color+'">'+title+'</div>'+
            '<div style="font-size:12px;color:var(--text2);margin-top:1px">'+action+'</div>'+
            '<div style="font-size:11px;color:var(--text3);margin-top:2px">'+detail+'</div>'+
          '</div>'+
        '</div>';
      },

      /* ─── Vor-Kredit Tools ─── */

      /* Populate global CCY select and init all Vor-Kredit tools */
      vorInit:function(){
        var sel=document.getElementById('vor-ccy');
        if(!sel)return;
        var ccys=['USD','EUR','CHF','CZK','PLN','USDC','USDT'];
        if(!sel.options.length)
          sel.innerHTML=ccys.map(function(c){return '<option'+(c==='USD'?' selected':'')+'>'+c+'</option>';}).join('');
        d.vorCcyChange();
      },
      vorCcyChange:function(){
        var ccy=d.vorGetCcy();
        var btcPrice=frU(R.BTC,ccy);
        var fmtBtc=ccy==='BTC'?'1':parseFloat(btcPrice.toFixed(ccy==='CZK'||ccy==='PLN'?0:2));
        /* Update BTC price display */
        var disp=document.getElementById('vor-btc-display');
        if(disp)disp.textContent=fmtBtc.toLocaleString('de-CH')+' '+ccy;
        /* Fill all BTC price inputs */
        ['mkb-btc','szb-btc','mkr-btc','btr-btc','ltvc-btc','alp-btc','bebp'].forEach(function(id){
          var el=document.getElementById(id);
          if(el){el.value=fmtBtc;el._vorAutoFilled=true;}
        });
        /* rosi-btc: convert to rosi's own currency */
        d.rosiCcyChange();
        /* Convert future BTC price fields to new currency */
        ['mkr-future-btc','btr-future'].forEach(function(id){
          var el=document.getElementById(id);
          if(el&&el.value){
            var usd=toU(parseFloat(el.value)||0,el._vorCcy||'USD');
            el.value=ccy==='BTC'?'1':parseFloat(frU(usd,ccy).toFixed(ccy==='CZK'||ccy==='PLN'?0:2));
          }
          if(el)el._vorCcy=ccy;
        });
        /* Update all monetary labels */
        var lbls={
          'mkb-btc-lbl':'Aktueller Bitcoin-Preis ('+ccy+')',
          'mkb-wert-lbl':'Wert der Bitcoin ohne Reserve ('+ccy+')',
          'mkb-zinsen-lbl':'Zinsen ('+ccy+')',
          'mkb-result-lbl':'Maximaler Kreditbetrag inkl. Bearbeitungsgeb\u00fchr ('+ccy+')',
          'szb-loan-lbl':'Kreditbetrag ('+ccy+')',
          'szb-zinsen-lbl':'Zinsen ('+ccy+')',
          'szb-fee-lbl':'Bearbeitungsgeb\u00fchr ('+ccy+')',
          'szb-btc-lbl':'Aktueller Bitcoin-Preis ('+ccy+')',
          'szb-mit-ccy-lbl':'Zu hinterlegende Sicherheit ('+ccy+')',
          'szb-ohne-ccy-lbl':'Zu hinterlegende Sicherheit ('+ccy+')',
          'mkr-btc-lbl':'Aktueller Bitcoin-Preis ('+ccy+')',
          'mkr-wert-lbl':'Aktueller Wert der Bitcoin ('+ccy+')',
          'mkr-zinsen-lbl':'Zinsen ('+ccy+')',
          'mkr-future-lbl':'Zuk\u00fcnftiger Bitcoinpreis ('+ccy+')',
          'btr-due-lbl':'F\u00e4lliger Betrag ('+ccy+')',
          'btr-btc-lbl':'Aktueller Bitcoin-Preis ('+ccy+')',
          'btr-future-lbl':'Zuk\u00fcnftiger Bitcoinpreis ('+ccy+')',
          'mkk-loan-lbl':'Kreditbetrag ('+ccy+')',
          'mkk-zinsen-lbl':'Zinsen ('+ccy+')',
          'mkk-fee-lbl':'Bearbeitungsgeb\u00fchr ('+ccy+')',
          'ltvc-loan-lbl':'Kreditbetrag ('+ccy+')',
          'ltvc-zinsen-lbl':'Zinsen ('+ccy+')',
          'ltvc-btc-lbl':'Aktueller Bitcoin-Preis ('+ccy+')',
          'alp-btc-lbl':'Aktueller Bitcoin-Preis ('+ccy+')',
          'bebp-lbl':'BTC-Preis bei Aufnahme ('+ccy+')',
          'gz-loan-lbl':'Kreditbetrag ('+ccy+')',
          'gvl-loan-lbl':'Kreditbetrag ('+ccy+')',
          'gvl-btcstart-lbl':null /* handled dynamically */,
          'gvl-btcnow-lbl':'Aktueller Bitcoin-Preis ('+ccy+')',
          'gvl-fee-lbl':'Bearbeitungsgeb\u00fchr ('+ccy+', auto)',
          'gvl-zinsen-lbl':'Zinsen ('+ccy+')',
          'gvl-gebühr-lbl':'Bearbeitungsgeb\u00fchr ('+ccy+')',
          'cn-loan-lbl':'Kreditbetrag ('+ccy+')',
          'nlp-due-lbl':'F\u00e4lliger Betrag (Kredit + Zinsen) ('+ccy+')',
          'nlp-old-lbl':'Bisheriger Liquidationspreis ('+ccy+')',
          'nlp-new-lbl':'Neuer Liquidationspreis ('+ccy+')',
          'se2-due-lbl':'F\u00e4lliger Betrag (Kredit + Zinsen) ('+ccy+')',
          'se2-target-lbl':'Ziel-Liquidationspreis ('+ccy+')',
          'se2-old-lbl':'Bisheriger Liquidationspreis ('+ccy+')'
        };
        Object.keys(lbls).forEach(function(id){
          var el=document.getElementById(id);
          if(el&&lbls[id]!==null)el.textContent=lbls[id];
        });
        /* Clear results and recalculate */
        /* Reconvert gvl-btcstart if raw USD stored */
        var bsEl=document.getElementById('gvl-btcstart');
        if(bsEl&&bsEl._btcStartUSD){bsEl.value=parseFloat(frU(bsEl._btcStartUSD,ccy).toFixed(ccy==='CZK'||ccy==='PLN'?0:2));}
        /* Update btcstart label with currency */
        var bsLbl=document.getElementById('gvl-btcstart-lbl');
        if(bsLbl){
          var dateSpan=document.getElementById('gvl-start-date');
          bsLbl.textContent='Bitcoin-Preis bei Kreditnahme ('+ccy+') ';
          if(dateSpan)bsLbl.appendChild(dateSpan);
        }
        d.mkb();d.szb();d.mkr();d.btr();d.mkk();d.ltvc();d.alp();d.gz();d.nach();d.nlp();d.se2();d.gvl();
      },
      vorGetCcy:function(){
        var sel=document.getElementById('vor-ccy');
        return sel?sel.value:'USD';
      },
      /* Read BTC price input and return USD value */
      vorBtcUSD:function(pfx){
        var ccy=d.vorGetCcy();
        var inp=document.getElementById(pfx+'-btc');
        if(!inp)return R.BTC;
        var val=parseFloat(inp.value);
        if(!val)return R.BTC;
        return toU(val,ccy);
      },
      /* Convert USD amount to display currency */
      vorFmt:function(usd){
        var ccy=d.vorGetCcy();
        var val=frU(usd,ccy);
        var decimals=ccy==='BTC'?8:ccy==='CZK'||ccy==='PLN'?0:2;
        return parseFloat(val.toFixed(decimals)).toLocaleString('de-CH')+'\u00a0'+ccy;
      },
      /* Read monetary input value in USD */
      vorReadUSD:function(id){
        var ccy=d.vorGetCcy();
        var el=document.getElementById(id);
        if(!el)return 0;
        var val=parseFloat((el.value+'').replace(/[^\d.-]/g,''))||0;
        return toU(val,ccy);
      },
      vorFillAll:function(){d.vorCcyChange();d.plInit();},
      vorFill:function(){d.vorCcyChange();},


      /* ─── Power Law Tools ─── */
      plDays:function(){
        var genesis=new Date(Date.UTC(2009,0,3));
        var now=new Date();
        now=new Date(Date.UTC(now.getUTCFullYear(),now.getUTCMonth(),now.getUTCDate()));
        return Math.floor((now-genesis)/86400000);
      },
      plFair:function(days){
        return Math.round(1.0117e-17*Math.pow(days,5.82));
      },
      plBottom:function(days){
        return Math.round(d.plFair(days)*0.42);
      },
      plInit:function(){
        var days=d.plDays();
        var fair=d.plFair(days);
        var bottom=d.plBottom(days);
        var btc=R.BTC;
        var g=function(id){return document.getElementById(id);};
        /* Tool 1: Fair Price */
        if(g('pl1-btc'))g('pl1-btc').textContent='$'+btc.toLocaleString('de-CH',{maximumFractionDigits:0});
        if(g('pl1-fair'))g('pl1-fair').textContent='$'+fair.toLocaleString('de-CH',{maximumFractionDigits:0});
        var dev1=((btc/fair-1)*100);
        if(g('pl1-dev')){g('pl1-dev').textContent=(dev1>=0?'+':'')+dev1.toFixed(1)+'%';g('pl1-dev').style.color=dev1<0?'var(--ok)':'var(--err)';}
        var v1=g('pl1-verdict');
        if(v1){
          if(dev1<0){v1.style.display='';v1.style.background='var(--ok-bg)';v1.style.color='var(--ok)';v1.style.border='1px solid var(--ok-border)';v1.textContent='\u2713 Bitcoin ist laut Power Law unterbewertet ('+dev1.toFixed(1)+'%). Kreditaufnahme ist gem\u00e4ss Strategie zul\u00e4ssig.';}
          else{v1.style.display='';v1.style.background='var(--err-bg)';v1.style.color='var(--err)';v1.style.border='1px solid var(--err-border)';v1.textContent='\u2717 Bitcoin ist laut Power Law \u00fcberbewertet (+'+dev1.toFixed(1)+'%). Kreditaufnahme ist gem\u00e4ss Strategie nicht empfohlen.';}
        }
        /* Tool 2 */
        d.pl2();
        /* Tool 3 & 4 */
        d.pl3();
        if(g('pl4-bottom'))g('pl4-bottom').textContent='$'+bottom.toLocaleString('de-CH',{maximumFractionDigits:0});
        if(g('pl4-btc'))g('pl4-btc').textContent='$'+btc.toLocaleString('de-CH',{maximumFractionDigits:0});
        d.pl4();
      },
      pl2:function(){
        var days=d.plDays();
        var fair=d.plFair(days);
        var bottom=d.plBottom(days);
        /* Nötiger Bitcoin-Preis: Bottom / 0.525 (Liquidation bei 95% LTV, Sicherheit = Kredit/0.5) */
        var needed=Math.round(bottom/0.525);
        var btc=R.BTC;
        var g=function(id){return document.getElementById(id);};
        if(g('pl2-btc'))g('pl2-btc').textContent='$'+btc.toLocaleString('de-CH',{maximumFractionDigits:0});
        if(g('pl2-fair'))g('pl2-fair').textContent='$'+fair.toLocaleString('de-CH',{maximumFractionDigits:0});
        if(g('pl2-bottom'))g('pl2-bottom').textContent='$'+bottom.toLocaleString('de-CH',{maximumFractionDigits:0});
        if(g('pl2-needed'))g('pl2-needed').textContent='$'+needed.toLocaleString('de-CH',{maximumFractionDigits:0});
        var dev2=((btc/fair-1)*100);
        if(g('pl2-dev')){g('pl2-dev').textContent=(dev2>=0?'+':'')+dev2.toFixed(1)+'%';g('pl2-dev').style.color=dev2<0?'var(--ok)':'var(--err)';}
        var v2=g('pl2-verdict');
        if(v2){
          if(btc<=needed){v2.style.background='var(--ok-bg)';v2.style.color='var(--ok)';v2.style.border='1px solid var(--ok-border)';v2.textContent='\u2192 Wenn ich bei einem Bitcoin-Preis von $'+needed.toLocaleString('de-CH',{maximumFractionDigits:0})+' einen Kredit nehmen würde, dann beträgt der Liquidationspreis des Kredits $'+bottom.toLocaleString('de-CH',{maximumFractionDigits:0})+'. Dies entspricht der heutigen Preisuntergrenze des Power Laws.';}
          else{v2.style.background='var(--warn-bg)';v2.style.color='var(--warn)';v2.style.border='1px solid var(--warn-border)';v2.textContent='\u2192 Wenn ich bei einem Bitcoin-Preis von $'+needed.toLocaleString('de-CH',{maximumFractionDigits:0})+' einen Kredit nehmen würde, dann beträgt der Liquidationspreis des Kredits $'+bottom.toLocaleString('de-CH',{maximumFractionDigits:0})+'. Dies entspricht der heutigen Preisuntergrenze des Power Laws.';}
        }
      },
      pl3:function(){
        var days=d.plDays();
        var fair=d.plFair(days);
        var btc=R.BTC;
        var thEl=document.getElementById('pl3-thresh');
        var thresh=thEl?parseInt(thEl.value)||0:0;
        var g=function(id){return document.getElementById(id);};
        var target=Math.round(fair*(1+thresh/100));
        if(g('pl3-btc'))g('pl3-btc').textContent='$'+btc.toLocaleString('de-CH',{maximumFractionDigits:0});
        if(g('pl3-target'))g('pl3-target').textContent='$'+target.toLocaleString('de-CH',{maximumFractionDigits:0});
        var dev3=((btc/fair-1)*100);
        if(g('pl3-dev')){g('pl3-dev').textContent=(dev3>=0?'+':'')+dev3.toFixed(1)+'% (Fair Price)';g('pl3-dev').style.color=dev3>=thresh?'var(--ok)':'var(--text3)';}
        var v3=g('pl3-verdict');
        if(v3){
          if(dev3>=thresh){v3.style.display='';v3.style.background='var(--ok-bg)';v3.style.color='var(--ok)';v3.style.border='1px solid var(--ok-border)';v3.textContent='\u2713 Bitcoin ($'+btc.toLocaleString('de-CH',{maximumFractionDigits:0})+') hat den Zielpreis ($'+target.toLocaleString('de-CH',{maximumFractionDigits:0})+') erreicht. Vorzeitige R\u00fcckzahlung ist gem\u00e4ss Strategie empfohlen.';}
          else{v3.style.display='';v3.style.background='var(--warn-bg)';v3.style.color='var(--warn)';v3.style.border='1px solid var(--warn-border)';v3.textContent='\u23f3 Bitcoin ($'+btc.toLocaleString('de-CH',{maximumFractionDigits:0})+') hat den Zielpreis ($'+target.toLocaleString('de-CH',{maximumFractionDigits:0})+') noch nicht erreicht. Noch '+(thresh-dev3).toFixed(1)+'% entfernt.';}
        }
      },
      pl4:function(){
        var days=d.plDays();
        var bottom=d.plBottom(days);
        var btc=R.BTC;
        var dueEl=document.getElementById('pl4-due');
        var due=dueEl?parseFloat(dueEl.value)||0:0;
        var g=function(id){return document.getElementById(id);};
        if(g('pl4-bottom'))g('pl4-bottom').textContent='$'+bottom.toLocaleString('de-CH',{maximumFractionDigits:0});
        if(g('pl4-btc'))g('pl4-btc').textContent='$'+btc.toLocaleString('de-CH',{maximumFractionDigits:0});
        if(!due){if(g('pl4-col'))g('pl4-col').textContent='\u2014';if(g('pl4-ltv'))g('pl4-ltv').textContent='\u2014';if(g('pl4-formula'))g('pl4-formula').textContent='';return;}
        var colNeeded=due/(bottom*0.95);
        var colCeil=Math.ceil(colNeeded*100000)/100000;
        var ltv=Math.round(due/(colCeil*btc)*100*10)/10;
        if(g('pl4-col'))g('pl4-col').textContent=colCeil.toFixed(5)+' BTC';
        if(g('pl4-ltv'))g('pl4-ltv').textContent=ltv.toFixed(1)+'%';
        if(g('pl4-formula'))g('pl4-formula').textContent='F\u00e4lliger Betrag $'+due.toLocaleString('de-CH',{maximumFractionDigits:0})+' \u00f7 (Bottom Price $'+bottom.toLocaleString('de-CH',{maximumFractionDigits:0})+' \u00d7 0.95)';
      },

      /* ── Roll-Over Simulation ── */
      rosi:function(){
        var amount=parseFloat(g('rosi-amount').value)||0;
        var ccy=g('rosi-ccy').value||'USD';
        var term=parseInt(g('rosi-term').value)||12;
        var rate1=parseFloat(g('rosi-rate1').value)||0;
        var rate2=parseFloat(g('rosi-rate2').value)||rate1;
        var btcP=parseFloat(g('rosi-btc').value)||frU(R.BTC,ccy);
        var btcPusd=toU(btcP,ccy); /* BTC price in USD for fee BTC conversion */
        var startEl=g('rosi-start');
        var baseDate=startEl&&startEl.value?new Date(startEl.value):new Date();
        var n=Math.max(1,Math.min(20,parseInt(g('rosi-n').value)||3));
        var el=g('rosi-r');
        if(!amount||!rate1){el.style.display='none';return;}
        /* All amounts stay in loan currency (ccy) — no USD conversion for display */
        function fmtC(v){return fmt(v,ccy);}
        var feeRatePa=0.015;
        var totalInterest=0,totalFee=0,totalVolume=0;
        var originalAmount=amount;
        var originalAmountUSD=toU(amount,ccy);
        var collateralBTC=btcPusd>0?originalAmountUSD/btcPusd:0;
        var rows='<thead><tr>'+
          '<th>#</th><th>Bezeichnung</th><th>Laufzeit</th><th>Zinssatz</th>'+
          '<th>Kreditbetrag ('+ccy+')</th><th>Zinsen ('+ccy+')</th><th>Gebühr</th>'+
          '<th>Fälliger Betrag ('+ccy+')</th><th>Gesamtkosten ('+ccy+')</th>'+
          '<th>Break-even BTC</th>'+
          '</tr></thead><tbody>';
        var currentAmount=amount;
        var feeDisplayEl=g('rosi-fee-display');
        var feeBtcFirst=0;
        for(var i=0;i<n;i++){
          var rate=i===0?rate1:rate2;
          var interest=currentAmount*(rate/100)*(term/12);
          var feeAmt=currentAmount*feeRatePa*(term/12);
          var feeBtc=btcPusd>0?toU(feeAmt,ccy)/btcPusd:0;
          var feePct=(feeRatePa*(term/12)*100).toFixed(2);
          if(i===0){feeBtcFirst=feeBtc;}
          if(i===0&&feeDisplayEl){
            feeDisplayEl.textContent=feePct+'% ('+fmtC(feeAmt)+' ≈ '+feeBtc.toFixed(6)+' BTC)';
          }
          var dueAmt=currentAmount+interest;
          var costAmt=interest+feeAmt;
          totalInterest+=interest;
          totalFee+=feeAmt;
          totalVolume+=currentAmount;
          var startD=new Date(baseDate);
          startD.setMonth(startD.getMonth()+i*term);
          var endD=new Date(startD);
          endD.setMonth(endD.getMonth()+term);
          var startStr=startD.toLocaleDateString('de-CH',{month:'short',year:'numeric'});
          var endStr=endD.toLocaleDateString('de-CH',{month:'short',year:'numeric'});
          var isLast=i===n-1;
          rows+='<tr'+(i>0?' style="background:var(--bg2)"':'')+'>'+
            '<td style="color:var(--text4);font-size:11px">'+(i+1)+'</td>'+
            '<td class="tbl-name">Roll-Over '+(i+1)+'<br><span style="font-size:10px;font-weight:400;color:var(--text4)">'+startStr+' \u2192 '+endStr+'</span></td>'+
            '<td>'+term+' Mt.</td>'+
            '<td>'+rate.toFixed(1)+'%</td>'+
            '<td class="amt"'+(i>0?' style="color:var(--text3)"':'')+'>'+fmtC(currentAmount)+(i>0?'<br><span style="font-size:10px;color:var(--text4)">\u2934 aus Vorperiode</span>':'')+'</td>'+
            '<td class="amt">'+fmtC(interest)+'</td>'+
            '<td class="amt">'+feePct+'%<br><span style="font-size:10px;color:var(--text4)">'+fmtC(feeAmt)+'</span></td>'+
            '<td class="amt" style="font-weight:700;color:'+(isLast?'var(--accent)':'var(--text)')+'">'+fmtC(dueAmt)+'</td>'+
            '<td class="amt">'+fmtC(costAmt)+'</td>'+
            (collateralBTC>0?'<td class="amt" style="font-size:11px">$'+(Math.round(btcPusd+toU(costAmt,ccy)/collateralBTC)).toLocaleString('de-CH')+'</td>':'<td class="amt" style="color:var(--text4)">—</td>')+
          '</tr>';
          currentAmount=dueAmt;
        }
        var totalCost=totalInterest+totalFee;
        var totalMonths=n*term;
        var finalDue=currentAmount;
        var endDate=new Date(baseDate);endDate.setMonth(endDate.getMonth()+totalMonths);
        var endDateStr=endDate.toLocaleDateString('de-CH',{day:'2-digit',month:'long',year:'numeric'});
        var effRate=originalAmount>0&&totalMonths>0?(totalCost/originalAmount/(totalMonths/12)*100):0;
        var capitalGrowth=originalAmount>0?((finalDue-originalAmount)/originalAmount*100):0;
        var startDateStr=baseDate.toLocaleDateString('de-CH',{day:'2-digit',month:'long',year:'numeric'});
        rows+='<tr style="background:var(--bg2);font-weight:700;border-top:2px solid var(--border)">'+
          '<td colspan="4" style="font-size:12px;color:var(--text4)">Total ('+n+' Roll-Over'+(n!==1?'s':'')+', '+totalMonths+' Monate)</td>'+
          '<td class="amt" style="color:var(--text3)">'+fmtC(originalAmount)+'<br><span style="font-size:10px;font-weight:400">Startbetrag</span></td>'+
          '<td class="amt">'+fmtC(totalInterest)+'</td>'+
          '<td class="amt">'+fmtC(totalFee)+'</td>'+
          '<td class="amt" style="color:var(--accent)">'+fmtC(finalDue)+'</td>'+
          '<td class="amt" style="color:var(--accent)">'+fmtC(totalCost)+'</td>'+
          (collateralBTC>0?'<td class="amt" style="font-size:11px;font-weight:700;color:var(--accent)">$'+(Math.round(btcPusd+toU(totalCost,ccy)/collateralBTC)).toLocaleString('de-CH')+'</td>':'<td class="amt" style="color:var(--text4)">—</td>')+
        '</tr></tbody>';
        g('rosi-tbl').innerHTML=rows;
        function tile(lbl,val,sub){
          return '<div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">'+
            '<div style="font-size:11px;color:var(--text4)">'+lbl+'</div>'+
            '<div style="font-size:15px;font-weight:700;color:var(--text)">'+val+'</div>'+
            (sub?'<div style="font-size:11px;color:var(--text3);margin-top:.2rem">'+sub+'</div>':'')+
          '</div>';
        }
        var feeTile=feeBtcFirst?tile('Geb\u00fchren gesamt',fmtC(totalFee),(feeBtcFirst*n).toFixed(6)+' BTC'):tile('Geb\u00fchren gesamt',fmtC(totalFee),'');
        g('rosi-summary').innerHTML=
          tile('Startdatum',startDateStr,'')+
          tile('Enddatum',endDateStr,'')+
          tile('Gesamtlaufzeit',totalMonths+' Monate',n+' Roll-Over'+(n!==1?'s':''))+
          tile('Startbetrag',fmtC(originalAmount),'')+
          tile('Endbetrag (f\u00e4lliger Betrag)',fmtC(finalDue),'+'+capitalGrowth.toFixed(1)+'%')+
          tile('Zinsen gesamt',fmtC(totalInterest),'')+
          tile('Gesamtvolumen',fmtC(totalVolume),'Summe aller Kreditbetr\u00e4ge')+
          feeTile+
          tile('Gesamtkosten',fmtC(totalCost),'Zinsen + Geb\u00fchren')+
          tile('Eff. Jahreszins',effRate.toFixed(2)+'%','\u00fcber gesamte Laufzeit');
        el.style.display='block';
      },

      /* ── Zukunftssimulation ── */
      zukunft:function(){
        var act=loans.filter(function(l){return l.status==='active';});
        var elR=g('zk-r'),elE=g('zk-empty');
        if(!elR)return;
        if(!act.length){elR.style.display='none';if(elE)elE.style.display='block';return;}
        if(elE)elE.style.display='none';

        var futBtc=parseFloat(g('zk-btc').value)||0;
        if(!futBtc){elR.style.display='none';return;}

        var dateEl=g('zk-date');
        var futDate=dateEl&&dateEl.value?new Date(dateEl.value):null;
        var extRate=parseFloat(g('zk-rate').value)||null; /* override rate for matured loans */

        var today=new Date();
        var _cs=getComputedStyle(document.getElementById('ffd-root'));
        var chGridColor=_cs.getPropertyValue('--border').trim();
        var COLORS=['#F97316','#3B82F6','#10B981','#8B5CF6','#EF4444','#F59E0B','#06B6D4','#EC4899'];

        /* ── Per-loan calculations ── */
        var rows=[];
        act.forEach(function(l,i){
          var startD=new Date(l.start);
          var matD=aM(l.start,l.term);
          var lU=toU(l.amount,l.c);

          /* At target date: is loan still running or already matured? */
          var targetD=futDate||matD; /* if no date given, use maturity */
          var isMatured=targetD>matD;

          var daysToMat=Math.max(0,(matD-today)/86400000);
          var daysToTarget=futDate?Math.max(0,(targetD-today)/86400000):daysToMat;

          /* Debt at target date */
          var debtAtTarget;
          if(!isMatured){
            /* Loan still active: debt = principal + full interest (bullet loan) */
            debtAtTarget=lU+intU(l);
          } else {
            /* Loan matured before target: roll debt with extRate or original rate */
            var extraMonths=Math.round((targetD-matD)/86400000/30.4375);
            var r=extRate!==null?extRate:l.rate;
            debtAtTarget=(lU+intU(l))*(1+(r/100)*(extraMonths/12));
          }

          /* Collateral value at target BTC price */
          var colValueNow=l.col*R.BTC;
          var colValueFut=l.col*futBtc;

          /* LTV at target */
          var ltvNow=colValueNow>0?lU/colValueNow*100:null;
          var ltvFut=colValueFut>0?debtAtTarget/colValueFut*100:null;

          /* MC1 price (73% LTV threshold) */
          var mc1=l.col>0?debtAtTarget/(0.73*l.col):null;

          /* P&L: collateral value gain minus cost of debt */
          var colGain=colValueFut-colValueNow;
          var debtCost=debtAtTarget-lU;
          var netPnl=colGain-debtCost;

          rows.push({
            l:l,i:i,
            lU:lU,
            debtNow:lU+intU(l),
            debtFut:debtAtTarget,
            colNow:colValueNow,
            colFut:colValueFut,
            ltvNow:ltvNow,
            ltvFut:ltvFut,
            mc1:mc1,
            netPnl:netPnl,
            isMatured:isMatured,
            daysToTarget:daysToTarget
          });
        });

        /* ── Summary tiles ── */
        var totalColNow=rows.reduce(function(s,r){return s+r.colNow;},0);
        var totalColFut=rows.reduce(function(s,r){return s+r.colFut;},0);
        var totalDebtNow=rows.reduce(function(s,r){return s+r.debtNow;},0);
        var totalDebtFut=rows.reduce(function(s,r){return s+r.debtFut;},0);
        var totalNetPnl=rows.reduce(function(s,r){return s+r.netPnl;},0);
        var colChange=(totalColNow>0?(totalColFut-totalColNow)/totalColNow*100:0);
        var btcChange=R.BTC>0?((futBtc-R.BTC)/R.BTC*100):0;

        function tile(lbl,val,sub,color){
          return '<div style="padding:.6rem .75rem;background:var(--bg2);border-radius:8px;border:1px solid var(--border)">'+
            '<div style="font-size:11px;color:var(--text4)">'+lbl+'</div>'+
            '<div style="font-size:15px;font-weight:700;color:'+(color||'var(--text)')+'">'+val+'</div>'+
            (sub?'<div style="font-size:11px;color:var(--text3);margin-top:.2rem">'+sub+'</div>':'')+
          '</div>';
        }
        var dateLabel=futDate?futDate.toLocaleDateString('de-CH',{day:'2-digit',month:'short',year:'numeric'}):'Fälligkeit';
        g('zk-summary').innerHTML=
          tile('BTC-Preis','$'+Math.round(R.BTC).toLocaleString('de-CH')+' → $'+Math.round(futBtc).toLocaleString('de-CH'),
            (btcChange>=0?'▲ +':' ▼ ')+Math.abs(btcChange).toFixed(1)+'%',btcChange>=0?'var(--ok)':'var(--err)')+
          tile('Collateral-Wert',fmt(totalColFut,'USD'),
            'Heute: '+fmt(totalColNow,'USD')+' · '+(colChange>=0?'▲ +':' ▼ ')+Math.abs(colChange).toFixed(1)+'%',
            colChange>=0?'var(--ok)':'var(--err)')+
          tile('Schulden gesamt',fmt(totalDebtFut,'USD'),'Heute: '+fmt(totalDebtNow,'USD'),'var(--text)')+
          tile('Netto-Position (Equity)',fmt(totalColFut-totalDebtFut,'USD'),
            'Heute: '+fmt(totalColNow-totalDebtNow,'USD'),
            (totalColFut-totalDebtFut)>=0?'var(--ok)':'var(--err)')+
          tile('Netto P&L',( totalNetPnl>=0?'▲ +':'▼ ')+fmt(Math.abs(totalNetPnl),'USD'),
            'Wertzuwachs abzgl. Zinskosten',totalNetPnl>=0?'var(--ok)':'var(--err)');

        /* ── Chart: BTC-Preisverlauf → Collateral & Schulden ── */
        /* Generate price steps from current BTC to futBtc */
        var steps=40;
        var pMin=Math.min(R.BTC,futBtc)*0.7;
        var pMax=Math.max(R.BTC,futBtc)*1.15;
        var labels=[],colData=[],debtData=[];
        for(var s=0;s<=steps;s++){
          var p=pMin+(pMax-pMin)*(s/steps);
          labels.push('$'+Math.round(p/1000)+'k');
          colData.push(rows.reduce(function(sum,r){return sum+r.l.col*p;},0));
          debtData.push(rows.reduce(function(sum,r){return sum+r.debtFut;},0));
        }
        /* Mark current and future price positions */
        var curIdx=Math.round((R.BTC-pMin)/(pMax-pMin)*steps);
        var futIdx=Math.round((futBtc-pMin)/(pMax-pMin)*steps);
        curIdx=Math.max(0,Math.min(steps,curIdx));
        futIdx=Math.max(0,Math.min(steps,futIdx));

        if(chZukunft){chZukunft.destroy();chZukunft=null;}
        var ctx=g('zk-chart');
        if(ctx){
          chZukunft=new Chart(ctx,{
            type:'line',
            data:{
              labels:labels,
              datasets:[
                {label:'Collateral-Wert (USD)',data:colData,borderColor:'#10B981',backgroundColor:'rgba(16,185,129,.08)',fill:true,tension:0.3,borderWidth:2,pointRadius:0,pointHoverRadius:4},
                {label:'Schulden (USD)',data:debtData,borderColor:'#EF4444',backgroundColor:'rgba(239,68,68,.06)',fill:true,tension:0,borderWidth:2,pointRadius:0,pointHoverRadius:4,borderDash:[5,3]}
              ]
            },
            options:{
              responsive:true,maintainAspectRatio:false,
              interaction:{mode:'index',intersect:false},
              plugins:{
                legend:{display:true,position:'top'},
                tooltip:{callbacks:{label:function(c){return c.dataset.label+': $'+Math.round(c.raw).toLocaleString('de-CH');}}},
                annotation:{} /* no dependency, skip */
              },
              scales:{
                y:{ticks:{callback:function(v){return '$'+Math.round(v/1000)+'k';}},grid:{color:chGridColor}},
                x:{grid:{display:false},ticks:{maxTicksLimit:8,autoSkip:true}}
              }
            }
          });
        }

        /* ── Table ── */
        var ltvColor=function(v){return v===null?'':v>=95?'#dc2626':v>=79?'#ea580c':v>=73?'#d97706':'#16a34a';};
        var tbl='<thead><tr>'+
          '<th>Kredit</th>'+
          '<th>Collateral</th>'+
          '<th>Wert heute</th>'+
          '<th>Wert bei $'+Math.round(futBtc/1000)+'k</th>'+
          '<th>Schulden heute</th>'+
          '<th>Schulden '+dateLabel+'</th>'+
          '<th>LTV heute</th>'+
          '<th>LTV '+dateLabel+'</th>'+
          '<th>MC1-Preis</th>'+
          '<th>Netto P&amp;L</th>'+
          '</tr></thead><tbody>';

        rows.forEach(function(r,i){
          var mc1Warn=r.mc1!==null&&futBtc<=r.mc1*1.1;
          tbl+='<tr'+(mc1Warn?' style="background:rgba(220,38,38,.06)"':'')+'>'+
            '<td class="tbl-name">'+r.l.name+
              (r.isMatured?'<br><span style="font-size:10px;color:var(--warn)">⚠ Fällig vor Zieldatum</span>':'')+'</td>'+
            '<td class="amt">'+r.l.col.toFixed(4)+' BTC</td>'+
            '<td class="amt">'+fmt(r.colNow,'USD')+'</td>'+
            '<td class="amt" style="font-weight:600;color:'+(r.colFut>=r.colNow?'var(--ok)':'var(--err)')+'">'+fmt(r.colFut,'USD')+'</td>'+
            '<td class="amt">'+fmt(r.debtNow,'USD')+'</td>'+
            '<td class="amt" style="font-weight:600">'+fmt(r.debtFut,'USD')+'</td>'+
            '<td class="amt" style="color:'+(r.ltvNow!==null?ltvColor(r.ltvNow):'')+'">'+
              (r.ltvNow!==null?r.ltvNow.toFixed(1)+'%':'—')+'</td>'+
            '<td class="amt" style="color:'+(r.ltvFut!==null?ltvColor(r.ltvFut):'')+'">'+
              (r.ltvFut!==null?r.ltvFut.toFixed(1)+'%':'—')+'</td>'+
            '<td class="amt" style="color:'+(r.mc1!==null&&futBtc<=r.mc1?'#dc2626':r.mc1!==null&&futBtc<=r.mc1*1.15?'#ea580c':'var(--text3)')+'">'+
              (r.mc1!==null?'$'+Math.round(r.mc1).toLocaleString('de-CH'):'—')+'</td>'+
            '<td class="amt" style="font-weight:600;color:'+(r.netPnl>=0?'var(--ok)':'var(--err)')+'">'+
              (r.netPnl>=0?'▲ +':'▼ ')+fmt(Math.abs(r.netPnl),'USD')+'</td>'+
          '</tr>';
        });

        /* Total row */
        tbl+='<tr style="font-weight:700;border-top:2px solid var(--border);background:var(--bg2)">'+
          '<td colspan="2" style="font-size:12px;color:var(--text4)">Total ('+rows.length+' Kredite)</td>'+
          '<td class="amt">'+fmt(totalColNow,'USD')+'</td>'+
          '<td class="amt" style="color:'+(totalColFut>=totalColNow?'var(--ok)':'var(--err)')+'">'+fmt(totalColFut,'USD')+'</td>'+
          '<td class="amt">'+fmt(totalDebtNow,'USD')+'</td>'+
          '<td class="amt">'+fmt(totalDebtFut,'USD')+'</td>'+
          '<td></td><td></td><td></td>'+
          '<td class="amt" style="color:'+(totalNetPnl>=0?'var(--ok)':'var(--err)')+'">'+
            (totalNetPnl>=0?'▲ +':'▼ ')+fmt(Math.abs(totalNetPnl),'USD')+'</td>'+
        '</tr></tbody>';

        g('zk-tbl').innerHTML=tbl;
        elR.style.display='block';
      },


      /* 1. Maximaler Kreditbetrag */
      mkb:function(){
        var btc=d.vorBtcUSD('mkb');
        var anz=parseFloat(g('mkb-btcanz').value);
        var res=parseFloat(g('mkb-res').value)||0;
        var rate=parseFloat(g('mkb-rate').value)||0;
        var termEl=document.querySelector('input[name="mkb-term"]:checked');
        var term=termEl?parseInt(termEl.value):12;
        if(!btc||!anz){g('mkb-result').textContent='—';g('mkb-wert').value='';g('mkb-zinsen').value='';return;}
        var collateral=(anz-res)*btc;
        g('mkb-wert').value=d.vorFmt(Math.round(collateral));
        var feerate=term===3?0.00375:term===6?0.0075:term===12?0.015:term===18?0.0225:0.03;
        var max=collateral/(2*(1+(rate/100)*(term/12))+feerate);
        var interest=max*(rate/100)*(term/12);
        g('mkb-zinsen').value=d.vorFmt(Math.round(interest));
        g('mkb-result').textContent=d.vorFmt(Math.round(max));
        var sl=g('mkb-rate-sl');if(sl&&parseFloat(sl.value)!==rate){sl.value=rate;g('mkb-rate-lbl').textContent=rate+' %';}
      },

      /* 2. Sicherheit zu Beginn */
      szb:function(){
        var loan=d.vorReadUSD('szb-loan');
        var zinsen=d.vorReadUSD('szb-zinsen');
        var btc=d.vorBtcUSD('szb');
        var nwfee=parseFloat(g('szb-nwfee').value)||0;
        var termEl=document.querySelector('input[name="szb-term"]:checked');
        var term=termEl?parseInt(termEl.value):12;
        if(!loan||!btc){g('szb-mit-btc').textContent='—';g('szb-mit-usd').textContent='—';g('szb-ohne-btc').textContent='—';g('szb-ohne-usd').textContent='—';if(g('szb-fee'))g('szb-fee').value='';return;}
        var feerate=term===3?0.00375:term===6?0.0075:term===12?0.015:term===18?0.0225:0.03;
        var calcFee=loan*feerate;
        var feeEl=g('szb-fee');
        if(!feeEl.value||feeEl._autoFilled){feeEl.value=d.vorFmt(Math.round(calcFee));feeEl._autoFilled=true;}
        var fee=d.vorReadUSD('szb-fee')||calcFee;
        /* Mit Gebühren */
        var mitUSD=(loan+zinsen)*2+fee;
        var mitBTC=(mitUSD/btc)+nwfee;
        /* Ohne Gebühren */
        var ohneUSD=(loan+zinsen)*2;
        var ohneBTC=ohneUSD/btc;
        g('szb-mit-btc').textContent=(Math.ceil(mitBTC*100000)/100000).toFixed(5)+' BTC';
        g('szb-mit-usd').textContent=d.vorFmt(Math.round(mitUSD));
        g('szb-ohne-btc').textContent=(Math.ceil(ohneBTC*100000)/100000).toFixed(5)+' BTC';
        g('szb-ohne-usd').textContent=d.vorFmt(Math.round(ohneUSD));
      },

      /* 3. Maximaler Kreditbetrag mit Reserve */
      mkr:function(){
        var btc=d.vorBtcUSD('mkr');
        var anz=parseFloat(g('mkr-btcanz').value);
        var rate=parseFloat(g('mkr-rate').value)||0;
        var termEl=document.querySelector('input[name="mkr-term"]:checked');
        var term=termEl?parseInt(termEl.value):12;
        var calcEl=document.querySelector('input[name="mkr-calc"]:checked');
        var calcMode=calcEl?calcEl.value:'pct';
        var dropPct=parseFloat(g('mkr-drop-sl').value)||0;
        var futureBtcIn=parseFloat(g('mkr-future-btc').value);
        var nwfee=parseFloat(g('mkr-nwfee').value)||0;
        var feeEl=g('mkr-fee');
        if(!btc||!anz){
          g('mkr-wert').value='';g('mkr-zinsen').value='';
          g('mkr-result-loan').textContent='—';g('mkr-result-res').textContent='—';
          g('mkr-check').style.display='none';return;
        }
        /* Aktueller Wert — nur Ausgabe runden */
        var wert=btc*anz;
        g('mkr-wert').value=d.vorFmt(Math.round(wert));
        /* Zukünftiger BTC-Preis — kein Round, exakter Wert für Berechnung */
        var fBtc=calcMode==='pct'?btc*(1-dropPct/100):(futureBtcIn||btc);
        if(calcMode==='pct'&&g('mkr-future-btc')){g('mkr-future-btc').value=Math.round(fBtc);}
        if(fBtc<=0){g('mkr-result-loan').textContent='—';return;}
        /* Gebührensatz */
        var feerate=term===3?0.00375:term===6?0.0075:term===12?0.015:term===18?0.0225:0.03;
        /* Kreditbetrag: exakte Formel, kein Round als Zwischenwert */
        var zf=1+(rate/100)*(term/12);
        var loan=(anz-nwfee)/(
          (zf/fBtc) +
          (feerate/btc) +
          (2*zf/btc)
        );
        if(loan<0)loan=0;
        /* Zinsen — kein Round als Zwischenwert */
        var interest=loan*(rate/100)*(term/12);
        /* Gebühren BTC — CEIL erst bei Ausgabe */
        var feeBTC=(feerate*loan/btc);
        /* Bitcoin-Reserve — CEIL erst bei Ausgabe */
        var resBTC=fBtc>0?(loan+interest)/fBtc:0;
        /* Liq-Warnung */
        var liqPct=((btc-fBtc)/btc*100);
        g('mkr-liq-warn').textContent='Bei einem Kursrückgang von 47.5% wird das Collateral liquidiert';
        /* Ausgaben — runden nur hier */
        if(!feeEl.value||feeEl._autoFilled){feeEl.value=(Math.ceil(feeBTC*100000)/100000).toFixed(5)+' BTC';feeEl._autoFilled=true;}
        g('mkr-zinsen').value=d.vorFmt(Math.round(interest));
        g('mkr-result-loan').textContent=d.vorFmt(Math.round(loan));
        g('mkr-result-res').textContent=(Math.ceil(resBTC*100000)/100000).toFixed(5)+' BTC';
        /* Überprüfungstext */
        var checkEl=g('mkr-check');
        checkEl.style.display='block';
        checkEl.textContent='Wenn Bitcoin auf den Preis '+d.vorFmt(Math.round(fBtc))+' fällt, habe ich noch eine Bitcoin-Reserve ('+(Math.ceil(resBTC*100000)/100000).toFixed(5)+' BTC) im Wert von '+d.vorFmt(Math.round(resBTC*fBtc))+', um den fälligen Betrag ('+d.vorFmt(Math.round(loan+interest))+') zurückzuzahlen.';
        var sl=g('mkr-rate-sl');if(sl&&parseFloat(sl.value)!==rate){sl.value=rate;g('mkr-rate-lbl').textContent=rate+' %';}
      },

      /* 4. Bitcoin-Reserve */
      btr:function(){
        var due=d.vorReadUSD('btr-due');
        var btc=d.vorBtcUSD('btr');
        var calcEl=document.querySelector('input[name="btr-calc"]:checked');
        var calcMode=calcEl?calcEl.value:'pct';
        var dropPct=parseFloat(g('btr-drop-sl').value)||0;
        var futureBtcIn=parseFloat(g('btr-future').value);
        if(!due||!btc){g('btr-result').textContent='—';g('btr-col').value='';g('btr-liq').value='';return;}
        /* Zukünftiger BTC-Preis */
        var fBtc=calcMode==='pct'?btc*(1-dropPct/100):(futureBtcIn||btc);
        if(calcMode==='pct'&&g('btr-future')){g('btr-future').value=Math.round(fBtc);}
        /* Zu hinterlegende Sicherheit: CEIL(fällig*2 / btc, 0.00001) */
        var colBTC=(due*2)/btc;
        /* Liquidationspreis: ROUND(btc/2 * 1.05) */
        var liqPrice=(btc/2)*1.05;
        /* Liq-Warnung: fix 47.5% */
        g('btr-liq-warn').textContent='Bei einem Kursrückgang von 47.5% wird das Collateral liquidiert';
        /* Bitcoin-Reserve: CEIL(fällig / fBtc, 0.00001) */
        var resBTC=fBtc>0?due/fBtc:0;
        /* Ausgaben - runden nur hier */
        g('btr-col').value=(Math.ceil(colBTC*100000)/100000).toFixed(5)+' BTC';
        g('btr-liq').value=d.vorFmt(Math.round(liqPrice));
        g('btr-result').textContent=(Math.ceil(resBTC*100000)/100000).toFixed(5)+' BTC';
      },

      /* 5. Mit Kredit Bitcoin kaufen */
      mkk:function(){
        var loan=d.vorReadUSD('mkk-loan');
        var zinsen=d.vorReadUSD('mkk-zinsen');
        var termEl=document.querySelector('input[name="mkk-term"]:checked');
        var term=termEl?parseInt(termEl.value):12;
        if(!loan){g('mkk-result').textContent='—';return;}
        /* Bearbeitungsgebuehr: auto-berechnet, editierbar */
        var feerate=term===3?0.00375:term===6?0.0075:term===12?0.015:term===18?0.0225:0.03;
        var calcFee=loan*feerate;
        var feeEl=g('mkk-fee');
        if(!feeEl.value||feeEl._autoFilled){feeEl.value=d.vorFmt(Math.round(calcFee));feeEl._autoFilled=true;}
        var fee=d.vorReadUSD('mkk-fee')||calcFee;
        /* Gekaufte Bitcoin: manueller Input */
        var btcBought=parseFloat(g('mkk-btcbuy').value)||0;
        /* Noetiger BTC-Preis: ROUND((Kredit + Zinsen + Gebuehr) / gekaufte BTC) */
        if(!btcBought){g('mkk-result').textContent='—';return;}
        var breakeven=(loan+zinsen+fee)/btcBought;
        g('mkk-result').textContent=d.vorFmt(Math.round(breakeven));
      },

      /* 6. LTV-Collateral-Rechner */
      ltvc:function(){
        var loan=d.vorReadUSD('ltvc-loan');
        var zinsen=d.vorReadUSD('ltvc-zinsen');
        var btc=d.vorBtcUSD('ltvc');
        var ltvPct=parseFloat(g('ltvc-ltv-sl').value)||50;
        if(!loan||!btc){g('ltvc-col-btc').textContent='—';g('ltvc-col-usd').textContent='—';g('ltvc-liq').textContent='—';return;}
        var due=loan+zinsen;
        /* CEIL((Kredit+Zinsen) / (LTV%/100) / BTC-Preis, 0.00001) */
        var colBTC=(due/(ltvPct/100))/btc;
        /* ROUND(colBTC * BTC-Preis) */
        var colUSD=colBTC*btc;
        /* ROUND((Kredit+Zinsen) / colBTC * 1.05) */
        var liqPrice=(due/colBTC)*1.05;
        /* Ausgaben — runden nur hier */
        g('ltvc-col-btc').textContent=(Math.ceil(colBTC*100000)/100000).toFixed(5)+' BTC';
        g('ltvc-col-usd').textContent=d.vorFmt(Math.round(colUSD));
        g('ltvc-liq').textContent=d.vorFmt(Math.round(liqPrice));
      },

      /* 7. Aktueller Liquidationspreis */
      alp:function(){
        var btc=d.vorBtcUSD('alp');
        if(!btc){g('alp-result').textContent='—';return;}
        /* ROUND(btc - (btc/2 * 0.95)) */
        var liq=btc-(btc/2*0.95);
        g('alp-result').textContent=d.vorFmt(Math.round(liq));
      },

      /* 8. Gesamte Zinsen */
      gz:function(){
        var loan=d.vorReadUSD('gz-loan');
        var rate=parseFloat(g('gz-rate').value)||0;
        var termEl=document.querySelector('input[name="gz-term"]:checked');
        var term=termEl?parseInt(termEl.value):12;
        if(!loan){g('gz-abs').textContent='—';g('gz-pct').textContent='—';return;}
        /* Absolute Zinsen: ROUND(Kredit * Zinssatz/100 * Laufzeit/12) */
        var interest=loan*(rate/100)*(term/12);
        /* Prozentuale Zinsen: CEIL(Zinssatz/100 * Laufzeit/12 * 100, 0.1) = CEIL(Zinssatz * Laufzeit/12, 0.1) */
        var pct=(rate/100)*(term/12)*100;
        g('gz-abs').textContent=d.vorFmt(Math.round(interest));
        g('gz-pct').textContent=(Math.ceil(pct*10)/10).toFixed(1)+'%';
        var sl=g('gz-rate-sl');if(sl&&parseFloat(sl.value)!=rate){sl.value=rate;g('gz-rate-lbl').textContent=rate+' %';}
      },

      /* ─── Verlängerungsszenarien ─── */
      gvlPopulate:function(){
        var sel=g('gvl-loan-sel');if(!sel)return;
        var act2=loans.filter(function(l){return l.status==='active';})
          .slice().sort(function(a,b){return aM(a.start,a.term)-aM(b.start,b.term);});
        var clo2=loans.filter(function(l){return l.status==='closed';})
          .slice().sort(function(a,b){return aM(b.start,b.term)-aM(a.start,a.term);});
        var avail=act2.concat(clo2);
        var cur=sel.value;
        sel.innerHTML='<option value="">— Kredit wählen —</option>'+
          avail.map(function(l){var i=loans.indexOf(l);var tag=l.status==='closed'?' ✓':' ●';return '<option value="'+i+'">'+l.name+tag+' ('+fmt(l.amount,l.c)+')</option>';}).join('');
        if(cur)sel.value=cur;
      },
      gvlFill:function(){
        var sel=g('gvl-loan-sel');if(!sel||!sel.value)return;
        var l=loans[parseInt(sel.value)];if(!l)return;
        var ccy=d.vorGetCcy();
        var lU=toU(l.amount,l.c);
        g('gvl-loan').value=parseFloat(frU(lU,ccy).toFixed(ccy==='CZK'||ccy==='PLN'?0:2));
        g('gvl-term').value=l.term||12;
        g('gvl-rate').value=l.rate||'';
        var termVal=l.term||12;
        var feerate=termVal===3?0.00375:termVal===6?0.0075:termVal===12?0.015:termVal===18?0.0225:0.03;
        var feeUSD=l.feeBtc?feeU(l):Math.round(lU*feerate);
        var feeFieldEl=g('gvl-fee');feeFieldEl._manualFee=false;feeFieldEl._autoFeeUSD=null;feeFieldEl.value=parseFloat(frU(feeUSD,ccy).toFixed(ccy==='CZK'||ccy==='PLN'?0:2));var feeBtn=g('gvl-fee-reset');if(feeBtn)feeBtn.style.display='none';
        g('gvl-btcnow').value=parseFloat(frU(R.BTC,ccy).toFixed(ccy==='CZK'||ccy==='PLN'?0:2));
        /* BTC-Startpreis: Feld immer zuerst leeren */
        var el=g('gvl-btcstart');
        if(d._gvlRetry){clearTimeout(d._gvlRetry);d._gvlRetry=null;}if(d._gvlAbort){d._gvlAbort.abort();d._gvlAbort=null;}
        el.value='';el.disabled=false;el.placeholder='80000';el._btcStartUSD=null;
        /* Startdatum anzeigen */
        var ds=g('gvl-start-date');
        if(ds)ds.textContent=l.start?('('+new Date(l.start).toLocaleDateString('de-CH')+')'):'';
        if(l.btcStart&&l.btcStart>0){
          /* Gespeicherter Wert vorhanden — l.btcStart ist immer USD */
          el._btcStartUSD=l.btcStart;
          el.value=parseFloat(frU(l.btcStart,ccy).toFixed(ccy==='CZK'||ccy==='PLN'?0:2));
          d.gvl();
        } else if(l.start){
          /* Historisch via Coingecko laden */
          d.gvlFetchHistoric(l.start,ccy);
        } else {
          d.gvl();
        }
      },
      /* Hintergrund-Prefetch aller benötigten historischen Preise beim Seitenload */
      prefetchHistPrices:function(){
        if(!loans.length)return;
        var dates={};
        var now=new Date();
        var firstOfThisMonth=new Date(now.getFullYear(),now.getMonth(),1);
        loans.forEach(function(l){
          if(!l.start)return;
          /* GVL: Startdatum des Kredits */
          dates[l.start]=1;
          /* Dcol-Chart: alle vergangenen Monatsersten ab Kreditstart */
          var s=new Date(l.start);
          var mStart=new Date(s.getFullYear(),s.getMonth(),1);
          for(var m=new Date(mStart);m<firstOfThisMonth;m=new Date(m.getFullYear(),m.getMonth()+1,1)){
            var iso=m.getFullYear()+'-'+String(m.getMonth()+1).padStart(2,'0')+'-01';
            dates[iso]=1;
          }
        });
        /* Fire-and-forget mit gestaffelten Delays — API nicht überlasten */
        var isos=Object.keys(dates);
        isos.forEach(function(iso,idx){
          setTimeout(function(){d.btcHistPrice(iso,function(){});},idx*300);
        });
      },
      /* Shared historic BTC price lookup with localStorage cache */
      loadHistBtc_auto:function(i,startDate,wid){
        /* Auto-load historic price silently on card render */
        var sugEl=g(wid+'-suggest');
        if(!sugEl||!startDate)return;
        d.btcHistPrice(startDate,function(usd){
          if(!usd){
            sugEl.style.display='block';
            sugEl.innerHTML=
              '<div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap">'+
                '<span style="font-size:11px;color:var(--warn)">&#9888; Historischer Preis konnte nicht geladen werden (CoinGecko Rate-Limit). Bitte manuell eintragen:</span>'+
                '<input id="bsw-manual-'+i+'" type="number" placeholder="z.B. 85000" step="1" style="width:110px;font-size:11px;padding:2px 6px;border:1px solid var(--border);border-radius:4px;background:var(--bg);color:var(--text)">'+
                '<button onclick="d.applyManualBtc('+i+')" style="font-size:11px;color:var(--accent);background:none;border:1px solid var(--accent);border-radius:4px;cursor:pointer;padding:2px 7px">Speichern</button>'+
              '</div>';
            return;
          }
          sugEl.style.display='block';
          sugEl.innerHTML=
            '<div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap">'+
              '<span style="font-size:11px;color:var(--text3)">Historischer Preis am '+new Date(startDate).toLocaleDateString('de-CH')+': <b style="color:var(--text)">$'+Math.round(usd).toLocaleString('de-CH')+'</b></span>'+
              '<button onclick="d.applyHistBtc('+i+','+Math.round(usd)+')" style="font-size:11px;color:#fff;background:var(--ok);border:none;border-radius:4px;cursor:pointer;padding:2px 8px">&#10003; Übernehmen</button>'+
              '<span style="font-size:11px;color:var(--text4)">oder eigener Preis:</span>'+
              '<input id="bsw-manual-'+i+'" type="number" placeholder="z.B. '+Math.round(usd)+'" step="1" style="width:110px;font-size:11px;padding:2px 6px;border:1px solid var(--border);border-radius:4px;background:var(--bg);color:var(--text)">'+
              '<button onclick="d.applyManualBtc('+i+')" style="font-size:11px;color:var(--accent);background:none;border:1px solid var(--accent);border-radius:4px;cursor:pointer;padding:2px 7px">Speichern</button>'+
            '</div>';
        });
      },
      loadHistBtc:function(i,lid,startDate){
        /* Manual trigger — same as auto but shows loading state */
        var wid='bsw-'+lid;
        var btn=event&&event.target;
        if(btn){btn.textContent='Laden…';btn.disabled=true;}
        d.btcHistPrice(startDate,function(usd){
          if(btn){btn.textContent='Historischen Preis laden';btn.disabled=false;}
          if(!usd){
            var sugEl=g(wid+'-suggest');
            if(sugEl){
              sugEl.style.display='block';
              sugEl.innerHTML=
                '<div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap">'+
                  '<span style="font-size:11px;color:var(--warn)">&#9888; Historischer Preis konnte nicht geladen werden (CoinGecko Rate-Limit). Bitte manuell eintragen:</span>'+
                  '<input id="bsw-manual-'+i+'" type="number" placeholder="z.B. 85000" step="1" style="width:110px;font-size:11px;padding:2px 6px;border:1px solid var(--border);border-radius:4px;background:var(--bg);color:var(--text)">'+
                  '<button onclick="d.applyManualBtc('+i+')" style="font-size:11px;color:var(--accent);background:none;border:1px solid var(--accent);border-radius:4px;cursor:pointer;padding:2px 7px">Speichern</button>'+
                '</div>';
            }
            return;
          }
          d.loadHistBtc_auto(i,startDate,wid);
        });
      },
      applyHistBtc:function(i,usd){
        loans[i].btcStart=usd;
        save();d.loans();d.ov();
      },
      applyManualBtc:function(i){
        var inp=g('bsw-manual-'+i);
        if(!inp)return;
        var val=parseFloat(inp.value);
        if(!val||val<=0)return;
        loans[i].btcStart=val;
        save();d.loans();d.ov();
      },
      btcHistPrice:function(dateISO, cb){
        if(!dateISO){cb(null,false);return;}
        /* 1. localStorage cache */
        var CACHE_KEY='ffd_btc_hist_'+dateISO;
        try{
          var cached=localStorage.getItem(CACHE_KEY);
          if(cached){var p=JSON.parse(cached);if(p&&p.usd){cb(p.usd,false);return;}}
        }catch(e){}
        /* 2. Hardcoded local price table (2022–2025, no API needed) */
        var local=btcHistLocal(dateISO);
        if(local){
          try{localStorage.setItem(CACHE_KEY,JSON.stringify({usd:local,ts:Date.now()}));}catch(e){}
          cb(local,false);return;
        }
        /* 3. Fallback: CoinGecko API (for dates outside hardcoded range) */
        var parts=dateISO.split('-');
        var cgDate=parts[2]+'-'+parts[1]+'-'+parts[0];
        fetch('https://api.coingecko.com/api/v3/coins/bitcoin/history?date='+cgDate+'&localization=false')
          .then(function(r){
            if(r.status===429){cb(null,'ratelimit');return null;}
            if(r.status===401||r.status===403){cb(null,'auth');return null;}
            if(!r.ok){cb(null,'error');return null;}
            return r.json();
          })
          .then(function(data){
            if(data===null||data===undefined)return;
            var usd=data&&data.market_data&&data.market_data.current_price&&data.market_data.current_price.usd;
            if(usd){try{localStorage.setItem(CACHE_KEY,JSON.stringify({usd:usd,ts:Date.now()}));}catch(e){}cb(usd,false);}
            else{cb(null,'notfound');}
          })
          .catch(function(){cb(null,'error');});
      },

      gvlApplyPrice:function(priceUSD){
        var el=g('gvl-btcstart');
        var hint=g('gvl-api-hint');
        el.disabled=false;
        el._btcStartUSD=priceUSD;
        var cur=d.vorGetCcy();
        el.value=parseFloat(frU(priceUSD,cur).toFixed(cur==='CZK'||cur==='PLN'?0:2));
        el.placeholder='';
        if(hint)hint.style.display='none';
        d.gvl();
      },
      gvlFetchHistoric:function(dateISO,ccy,retryCount){
        retryCount=retryCount||0;
        var CACHE_KEY='ffd_btc_hist_'+dateISO;
        /* 1. Cache prüfen */
        try{
          var cached=localStorage.getItem(CACHE_KEY);
          if(cached){var parsed=JSON.parse(cached);if(parsed&&parsed.usd){d.gvlApplyPrice(parsed.usd);return;}}
        }catch(e){}
        /* 2. Hardcoded local price table */
        var local=btcHistLocal(dateISO);
        if(local){
          try{localStorage.setItem(CACHE_KEY,JSON.stringify({usd:local,ts:Date.now()}));}catch(e){}
          d.gvlApplyPrice(local);return;
        }
        /* 3. Laufenden Request abbrechen, dann CoinGecko */
        if(d._gvlAbort){d._gvlAbort.abort();}
        var ctrl=new AbortController();
        d._gvlAbort=ctrl;
        var parts=dateISO.split('-');
        var cgDate=parts[2]+'-'+parts[1]+'-'+parts[0];
        var el=g('gvl-btcstart');
        var hint=g('gvl-api-hint');
        if(retryCount===0){el.value='';el.placeholder='Laden…';el.disabled=true;}
        if(hint)hint.style.display='none';
        fetch('https://api.coingecko.com/api/v3/coins/bitcoin/history?date='+cgDate+'&localization=false',{signal:ctrl.signal})
          .then(function(r){if(r.status===429){throw {rateLimit:true};}return r.json();})
          .then(function(data){
            d._gvlAbort=null;
            var priceUSD=data&&data.market_data&&data.market_data.current_price&&data.market_data.current_price.usd;
            if(priceUSD){
              try{localStorage.setItem(CACHE_KEY,JSON.stringify({usd:priceUSD,ts:Date.now()}));}catch(e){}
              d.gvlApplyPrice(priceUSD);
            } else {
              el.disabled=false;el._btcStartUSD=null;el.placeholder='Nicht gefunden';
              d.gvl();
            }
          })
          .catch(function(err){
            if(err&&err.name==='AbortError')return;
            d._gvlAbort=null;
            if(err&&err.rateLimit){
              var MAX_RETRIES=4;
              if(retryCount<MAX_RETRIES){
                var delay=Math.pow(2,retryCount)*5000;
                var remaining=Math.round(delay/1000);
                if(hint){hint.textContent='⏳ API-Limit erreicht — neuer Versuch in '+remaining+'s…';hint.style.display='block';}
                el.placeholder='Warte…';
                d._gvlRetry=setTimeout(function(){d.gvlFetchHistoric(dateISO,d.vorGetCcy(),retryCount+1);},delay);
              } else {
                el.disabled=false;el.placeholder='Bitte später erneut versuchen';
                if(hint){hint.textContent='⚠️ API-Limit erreicht — bitte kurz warten und Kredit erneut auswählen';hint.style.display='block';}
                d.gvl();
              }
            } else {
              el.disabled=false;el.placeholder='Fehler beim Laden';
              d.gvl();
            }
          });
      },
      gvlFeeManual:function(){
        var feeEl=g('gvl-fee');
        if(feeEl){feeEl._manualFee=true;}
        d.gvl();
      },
      autoFillBtcStart:function(dateId,priceId,hintId){
        var dateEl=g(dateId),priceEl=g(priceId),hintEl=g(hintId);
        if(!dateEl||!priceEl||!hintEl)return;
        var iso=dateEl.value;
        if(!iso){hintEl.style.display='none';return;}
        hintEl.innerHTML='<span style="font-size:11px;color:var(--text4)">⏳ Lade…</span>';
        hintEl.style.display='block';
        d.btcHistPrice(iso,function(usd,err){
          if(usd){
            var rounded=Math.round(usd);
            var dateStr=new Date(iso).toLocaleDateString('de-CH');
            var btn='<button onclick="var f=document.getElementById(\''
              +priceId+'\');if(f)f.value='+rounded
              +';document.getElementById(\''+hintId+'\').style.display=\'none\'"'
              +' style="font-size:11px;color:#fff;background:var(--ok);border:none;border-radius:4px;cursor:pointer;padding:2px 8px">'
              +'\u2713 \xdcbernehmen</button>';
            hintEl.innerHTML=
              '<div style="display:inline-flex;align-items:center;gap:8px;flex-wrap:wrap;margin-top:3px">'
              +'<span style="font-size:11px;color:var(--text3)">Kurs am '+dateStr+': <b style="color:var(--text)">$'
              +rounded.toLocaleString('de-CH')+'</b></span>'+btn+'</div>';
          }else{
            hintEl.innerHTML='<span style="font-size:11px;color:var(--warn)">'
              +(err==='ratelimit'?'⚠ API-Limit — bitte manuell eintragen':'⚠ Kurs nicht gefunden — bitte manuell eintragen')
              +'</span>';
          }
        });
      },
      gvlFeeReset:function(){
        var feeEl=g('gvl-fee');
        if(feeEl){feeEl._manualFee=false;feeEl._autoFeeUSD=null;}
        var btn=g('gvl-fee-reset');if(btn)btn.style.display='none';
        d.gvl();
      },
      gvl:function(){
        var lU=d.vorReadUSD('gvl-loan');
        var term=parseInt(g('gvl-term').value)||12;
        var rate=parseFloat(g('gvl-rate').value)||0;
        var feeInput=parseFloat((g('gvl-fee').value||'').replace(/[^\d.-]/g,''))||0;
        /* BTC-Startpreis: bevorzuge gespeicherten USD-Rohwert, sonst vorReadUSD */
        var btcStartEl=g('gvl-btcstart');
        var btcStart=btcStartEl&&btcStartEl._btcStartUSD?btcStartEl._btcStartUSD:d.vorReadUSD('gvl-btcstart');
        var btcNow=d.vorReadUSD('gvl-btcnow');
        if(!lU||!btcStart||!btcNow){g('gvl-r').style.display='none';return;}
        var feerate=term===3?0.00375:term===6?0.0075:term===12?0.015:term===18?0.0225:0.03;
        var feeEl=g('gvl-fee');
        var feeResetBtn=g('gvl-fee-reset');
        if(!feeEl._manualFee){
          /* Auto: berechne und fülle */
          var autoFeeUSD=Math.round(lU*feerate);
          var ccy=d.vorGetCcy();
          feeEl.value=parseFloat(frU(autoFeeUSD,ccy).toFixed(ccy==='CZK'||ccy==='PLN'?0:2));
          feeEl._autoFeeUSD=autoFeeUSD;
          if(feeResetBtn)feeResetBtn.style.display='none';
        } else {
          if(feeResetBtn)feeResetBtn.style.display='inline';
        }
        var feeUSD=feeEl._manualFee?d.vorReadUSD('gvl-fee'):(feeEl._autoFeeUSD||Math.round(lU*feerate));
        /* Zinsen */
        var interestUSD=lU*(rate/100)*(term/12);
        /* BTC-Menge die man hätte verkaufen müssen: CEIL(Kredit/BTC-Start, 0.00001) */
        var btcAmt=Math.ceil((lU/btcStart)*100000)/100000;
        /* Heutiger Wert dieser BTC */
        var btcValNow=Math.round(btcAmt*btcNow);
        /* Gewinn/Verlust: HeutigerWert - WertBeimVerkauf - Kosten */
        var sellValue=Math.round(btcAmt*btcStart);
        var result=Math.round(btcValNow-sellValue-(interestUSD+feeUSD));
        g('gvl-r').style.display='block';
        g('gvl-btcamt').textContent=(Math.ceil((lU/btcStart)*100000)/100000).toFixed(5)+' BTC';
        g('gvl-btcval').textContent=d.vorFmt(btcValNow);
        g('gvl-zinsen').textContent=d.vorFmt(Math.round(interestUSD));
        g('gvl-gebuehr').textContent=d.vorFmt(Math.round(feeUSD));
        var color=result>0?'#16a34a':result<0?'#dc2626':'var(--text1)';
        var sign=result>0?'+ ':'';
        g('gvl-result').innerHTML='<span style="color:'+color+'">'+sign+d.vorFmt(result)+'</span>';
      },
      extPopulate:function(){
        var sel=g('ext-loan');if(!sel)return;
        var act=loans.filter(function(l){return l.status==='active';})
          .slice().sort(function(a,b){return aM(a.start,a.term)-aM(b.start,b.term);});
        sel.innerHTML='<option value="">— Kredit wählen —</option>'+
          act.map(function(l,i){return '<option value="'+loans.indexOf(l)+'">'+l.name+' ('+fmt(l.amount,l.c)+')</option>';}).join('');
        /* also populate rosi selector */
        var rsel=g('rosi-loan-sel');if(!rsel)return;
        rsel.innerHTML='<option value="">— Kredit wählen —</option>'+
          act.map(function(l){return '<option value="'+loans.indexOf(l)+'">'+l.name+' ('+fmt(l.amount,l.c)+')</option>';}).join('');
      },
      rosiCcyChange:function(){
        var ccy=g('rosi-ccy').value||'USD';
        var btcEl=g('rosi-btc');
        var lbl=g('rosi-btc-lbl');
        if(lbl)lbl.textContent='BTC-Preis ('+ccy+')';
        if(btcEl){
          /* Convert stored or current BTC price to new currency */
          var prevUSD=btcEl._btcUSD||R.BTC;
          btcEl._btcUSD=R.BTC;
          var newVal=ccy==='BTC'?1:parseFloat(frU(R.BTC,ccy).toFixed(ccy==='CZK'||ccy==='PLN'?0:2));
          btcEl.value=newVal;
        }
      },
      rosiFill:function(){
        var idx=parseInt(g('rosi-loan-sel').value);
        if(isNaN(idx)||!loans[idx])return;
        var l=loans[idx];
        g('rosi-amount').value=l.amount;
        /* set currency */
        var ccySel=g('rosi-ccy');
        for(var i=0;i<ccySel.options.length;i++){if(ccySel.options[i].value===l.c){ccySel.selectedIndex=i;break;}}
        /* update BTC price label and value to match loan currency */
        d.rosiCcyChange();
        /* start date */
        var startEl=g('rosi-start');if(startEl&&l.start)startEl.value=l.start;
        /* set term */
        var termSel=g('rosi-term');
        for(var i=0;i<termSel.options.length;i++){if(parseInt(termSel.options[i].value)===l.term){termSel.selectedIndex=i;break;}}
        /* rate */
        g('rosi-rate1').value=l.rate;
        g('rosi-rate2').value=l.rate;
        d.rosi();
      },
      ext:function(){
        var idx=parseInt(g('ext-loan').value);
        var r=g('ext-r'),info=g('ext-info');
        if(isNaN(idx)||!loans[idx]){
          r.style.display='none';
          info.textContent='—';
          g('ext-due').textContent='—';
          g('ext-start').textContent='—';
          return;
        }
        var l=loans[idx];
        var lU=toU(l.amount,l.c);
        var due=dueU(l);
        var endDate=aM(l.start,l.term);
        /* Pre-fill slider with loan rate only when loan changes */
        var slider=g('ext-rate');
        if(slider._lastIdx!==idx){
          slider._lastIdx=idx;
          slider.value=l.rate<=20?l.rate:20;
          g('ext-rate-val').textContent=parseFloat(slider.value)+'%';
        }
        var rate=parseFloat(slider.value);
        info.textContent=fmt(l.amount,l.c)+' · '+l.rate+'% p.a. · Laufzeit '+l.term+' Mo';
        g('ext-due').textContent=fmt(frU(due,l.c),l.c)+' = $'+Math.round(due).toLocaleString('de-CH');
        g('ext-start').textContent=endDate.toLocaleDateString('de-CH');
        r.style.display='block';
        var exts=[3,6,12,18,24];
        g('ext-grid').innerHTML=exts.map(function(mo){
          var base=frU(due,l.c);
          var addInterest=base*(rate/100)*(mo/12);
          var addUSD=toU(addInterest,l.c);
          var newEnd=new Date(endDate);
          newEnd.setMonth(newEnd.getMonth()+mo);
          return '<div class="card" style="border:1px solid var(--border);box-shadow:none;padding:.75rem">'+
            '<div style="font-size:13px;font-weight:700;color:var(--accent);margin-bottom:.4rem">+'+mo+' Monate</div>'+
            '<div style="font-size:12px;color:var(--text2);margin-bottom:2px">Zusatzkosten: <b>'+fmt(addInterest,l.c)+'</b></div>'+
            '<div style="font-size:12px;color:var(--text3);margin-bottom:2px">= $'+addUSD.toLocaleString('de-CH',{maximumFractionDigits:0})+'</div>'+
            '<div style="font-size:12px;font-weight:600;color:var(--text);margin:.4rem 0 2px;border-top:1px solid var(--border);padding-top:.4rem">Endbetrag: '+fmt(base+addInterest,l.c)+'</div>'+
            '<div style="font-size:11px;color:var(--text4)">Startbetrag: '+fmt(base,l.c)+'</div>'+
            '<div style="font-size:11px;color:var(--text4)">Start: '+endDate.toLocaleDateString('de-CH')+'</div>'+
            '<div style="font-size:11px;color:var(--text4)">Ende: '+newEnd.toLocaleDateString('de-CH')+'</div>'+
          '</div>';
        }).join('');
      },

      /* ─── Worst-Case-Simulator ─── */
      wc:function(){
        var simBtc=parseFloat(g('wc-btc').value);
        var pctEl=g('wc-pct'),rEl=g('wc-r');
        if(!simBtc||simBtc<=0){rEl.innerHTML='';pctEl.textContent='';return;}
        var diff=((simBtc-R.BTC)/R.BTC*100).toFixed(1);
        pctEl.textContent=(diff>0?'+':'')+diff+'% vs. aktuell ($'+R.BTC.toLocaleString('de-CH',{maximumFractionDigits:0})+')';
        pctEl.style.color=diff<0?'#dc2626':'#16a34a';
        var act=loans.filter(function(l){return l.status==='active'&&l.col>0;});
        if(!act.length){rEl.innerHTML='<p class="note2">Keine aktiven Kredite mit Collateral.</p>';return;}
        /* Sort: most endangered first (highest simulated LTV, Kapital+Zinsen) */
        var sorted=act.slice().sort(function(a,b){
          var dueA=toU(a.amount,a.c)+intU(a),dueB=toU(b.amount,b.c)+intU(b);
          return (dueB/(b.col*simBtc))-(dueA/(a.col*simBtc));
        });
        var rows=sorted.map(function(l){
          var lU=toU(l.amount,l.c);
          var interestUSD=intU(l);
          var due=lU+interestUSD;
          var curLtv=(due/(l.col*R.BTC))*100;
          var simLtv=(due/(l.col*simBtc))*100;
          /* MC trigger prices (BTC/USD) — all use due (Kapital + Zinsen) */
          var mc1P=due/0.73/l.col;
          var mc2P=due/0.79/l.col;
          var mc3P=due/0.86/l.col;
          var liqP=due/(0.95*l.col);
          /* Status based on simulated price vs trigger prices */
          var status=simBtc<=liqP?'liq':simBtc<=mc3P?'mc3':simBtc<=mc2P?'mc2':simBtc<=mc1P?'mc1':'safe';
          var statusLabel={'liq':'⚠️ Liquidiert','mc3':'⚠️ MC3 erreicht (86%)','mc2':'⚠️ MC2 erreicht (79%)','mc1':'⚠️ MC1 erreicht (73%)','safe':'✓ Sicher'}[status];
          var statusColor={'liq':'#dc2626','mc3':'#dc2626','mc2':'#ea580c','mc1':'#d97706','safe':'#16a34a'}[status];
          /* Next threshold the sim price is approaching */
          var nextThreshP=simBtc>mc1P?mc1P:simBtc>mc2P?mc2P:simBtc>mc3P?mc3P:liqP;
          var nextThreshLabel=simBtc>mc1P?'MC1':simBtc>mc2P?'MC2':simBtc>mc3P?'MC3':'Liq.';
          var pufferToNext=simBtc>liqP?((simBtc-nextThreshP)/simBtc*100).toFixed(1):null;
          return '<div style="border-radius:10px;margin-bottom:.6rem;background:var(--bg2);border:1px solid '+(status==='safe'?'var(--border)':statusColor+'44')+';overflow:hidden">'+
            /* Header row */
            '<div style="display:flex;justify-content:space-between;align-items:center;padding:.6rem .85rem;border-bottom:1px solid var(--border)">'+
              '<div>'+
                '<b style="font-size:13px;color:var(--text)">'+l.name+'</b>'+
                '<span style="font-size:11px;color:var(--text4);margin-left:6px">'+fmt(l.amount,l.c)+' · '+l.col+' BTC</span>'+
              '</div>'+
              '<div style="text-align:right">'+
                '<span style="font-size:14px;font-weight:700;color:'+statusColor+'">'+simLtv.toFixed(1)+'%</span>'+
                '<span style="display:block;font-size:11px;color:'+statusColor+';font-weight:600">'+statusLabel+'</span>'+
              '</div>'+
            '</div>'+
            /* Detail row */
            '<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:0;font-size:11px;text-align:center">'+
              '<div style="padding:.45rem .5rem;border-right:1px solid var(--border)">'+
                '<span style="color:var(--text4);display:block">LTV aktuell</span>'+
                '<b style="color:'+lc(curLtv)+'">'+curLtv.toFixed(1)+'%</b>'+
              '</div>'+
              '<div style="padding:.45rem .5rem;border-right:1px solid var(--border)">'+
                '<span style="color:var(--text4);display:block">MC1 bei</span>'+
                '<b style="color:'+(simBtc<=mc1P?'#dc2626':'#d97706')+'">'+(mc1P?'$'+Math.round(mc1P).toLocaleString('de-CH'):'–')+'</b>'+
              '</div>'+
              '<div style="padding:.45rem .5rem;border-right:1px solid var(--border)">'+
                '<span style="color:var(--text4);display:block">MC3 bei</span>'+
                '<b style="color:'+(simBtc<=mc3P?'#dc2626':'#ea580c')+'">'+(mc3P?'$'+Math.round(mc3P).toLocaleString('de-CH'):'–')+'</b>'+
              '</div>'+
              '<div style="padding:.45rem .5rem">'+
                '<span style="color:var(--text4);display:block">Liq. bei</span>'+
                '<b style="color:'+(simBtc<=liqP?'#dc2626':'#7c3aed')+'">'+(liqP?'$'+Math.round(liqP).toLocaleString('de-CH'):'–')+'</b>'+
              '</div>'+
            '</div>'+
            (pufferToNext?'<div style="padding:.3rem .85rem;font-size:11px;color:var(--text3);border-top:1px solid var(--border);background:var(--warn-bg)">Noch '+pufferToNext+'% Abstand bis '+nextThreshLabel+'</div>':'')+
          '</div>';
        });
        rEl.innerHTML=rows.join('');
      },

      /* ─── Opportunity Cost + EAR ─── */
      /* ─── Historical BTC in LTV chart (Diagramme) ─── */
      fetchBtcHistory:function(cb,retryCount){
        if(window._btcHist){cb(window._btcHist);return;}
        retryCount=retryCount||0;
        fetch('https://api.coingecko.com/api/v3/coins/bitcoin/market_chart?vs_currency=usd&days=365&interval=daily')
          .then(function(r){
            if(r.status===429){throw {rateLimit:true};}
            return r.json();
          })
          .then(function(data){
            if(data&&data.prices){
              window._btcHist={};
              data.prices.forEach(function(p){
                var dt=new Date(p[0]);
                var key=dt.getFullYear()+'-'+String(dt.getMonth()+1).padStart(2,'0')+'-'+String(dt.getDate()).padStart(2,'0');
                window._btcHist[key]=p[1];
              });
              cb(window._btcHist);
            } else { cb(null); }
          }).catch(function(err){
            if(err&&err.rateLimit&&retryCount<4){
              setTimeout(function(){d.fetchBtcHistory(cb,retryCount+1);},Math.pow(2,retryCount)*5000);
            } else { cb(null); }
          });
      },

      setLtvThresh:function(v){
        var n=parseInt(v);
        if(isNaN(n)||n<0||n>100)return;
        ltvThresh=n;
        localStorage.setItem('ffd_ltv_thresh',n);
        d.ov();
      },
      /* ─── Roll-Over: chain dropdown helper ─── */
      populateChainSelect:function(elId,excludeIdx,currentChainId){
        var sel=g(elId);if(!sel)return;
        sel.innerHTML='<option value="">— Keine Kette —</option><option value="__new__">✦ Neue Kette starten</option>';
        loans.forEach(function(l,i){
          if(i===excludeIdx)return;
          var opt=document.createElement('option');
          opt.value=l.id;
          opt.textContent=l.name+' ('+fmt(l.amount,l.c)+')'+(l.chainId?' 🔗':'');
          /* pre-select if this loan shares the same chainId */
          if(currentChainId&&l.chainId===currentChainId)opt.selected=true;
          sel.appendChild(opt);
        });
      },

      /* ─── Roll-Over overview ─── */
      ro:function(){
        var el=g('ro-content');if(!el)return;
        /* Group loans by chainId */
        var chains={};
        loans.forEach(function(l){
          if(!l.chainId)return;
          if(!chains[l.chainId])chains[l.chainId]=[];
          chains[l.chainId].push(l);
        });
        var chainIds=Object.keys(chains);
        /* Loans without a chain */
        var standalone=loans.filter(function(l){return !l.chainId;});

        if(!chainIds.length){
          el.innerHTML='<div class="card" style="text-align:center;padding:2rem">'+
            '<div style="font-size:32px;margin-bottom:.75rem">🔗</div>'+
            '<div style="font-size:15px;font-weight:600;color:var(--text);margin-bottom:.5rem">Noch keine Roll-Over-Ketten</div>'+
            '<p class="note2">Verknüpfe Kredite miteinander, indem du bei einem Kredit unter «Roll-Over-Kette» einen Vorgänger-Kredit auswählst.</p>'+
          '</div>';
          return;
        }

        var CHAIN_COLORS=['#F97316','#3b82f6','#8b5cf6','#10b981','#f59e0b','#ec4899','#06b6d4','#84cc16'];
        var html='';

        chainIds.forEach(function(cid,ci){
          var members=chains[cid].slice().sort(function(a,b){return new Date(a.start)-new Date(b.start);});
          var color=CHAIN_COLORS[ci%CHAIN_COLORS.length];

          /* Aggregate totals */
          var totalInterestUSD=members.reduce(function(s,l){return s+intU(l);},0);
          var totalFeeUSD=members.reduce(function(s,l){return s+feeU(l);},0);
          var totalCostUSD=totalInterestUSD+totalFeeUSD;
          var totalFeeBtc=members.reduce(function(s,l){return s+(l.feeBtc||0);},0);
          var totalDueUSD=members.reduce(function(s,l){return s+toU(l.amount,l.c)+intU(l);},0);
          var activeCount=members.filter(function(l){return l.status==='active';}).length;
          var closedCount=members.length-activeCount;
          var firstStart=new Date(members[0].start);
          var lastEnd=aM(members[members.length-1].start,members[members.length-1].term);
          var totalMonths=Math.round((lastEnd-firstStart)/(1000*60*60*24*30.44));
          var avgAmount=members.reduce(function(s,l){return s+toU(l.amount,l.c);},0)/members.length;
          /* Weighted avg rate */
          var wRateNum=members.reduce(function(s,l){return s+l.rate*toU(l.amount,l.c);},0);
          var wRateDen=members.reduce(function(s,l){return s+toU(l.amount,l.c);},0);
          var avgRate=wRateDen>0?wRateNum/wRateDen:0;
          /* Effective annual rate = totalCostUSD / avgAmount / (totalMonths/12) */
          var effRate=avgAmount>0&&totalMonths>0?(totalCostUSD/avgAmount/(totalMonths/12)*100):0;
          /* Chain name = name of first loan */
          var chainName=members[0].name.replace(/ v\d+$/i,'').replace(/ \(Kopie\)$/i,'');

          html+='<div class="card" style="margin-bottom:1rem;border-left:4px solid '+color+'">';
          /* Header */
          html+='<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.5rem;margin-bottom:.75rem">'+
            '<div style="display:flex;align-items:center;gap:.6rem">'+
              '<span style="font-size:18px">🔗</span>'+
              '<div>'+
                '<div style="font-size:14px;font-weight:700;color:var(--text)">'+chainName+'</div>'+
                '<div style="font-size:11px;color:var(--text4)">'+
                  members.length+' Kredit'+(members.length!==1?'e':'')+
                  (activeCount?' · <span style="color:var(--ok)">'+activeCount+' aktiv</span>':'')+
                  (closedCount?' · <span style="color:var(--text3)">'+closedCount+' abg.</span>':'')+
                  ' · '+firstStart.toLocaleDateString('de-CH',{month:'short',year:'numeric'})+' → '+
                  lastEnd.toLocaleDateString('de-CH',{month:'short',year:'numeric'})+
                  ' ('+totalMonths+' Monate gesamt)'+
                '</div>'+
              '</div>'+
            '</div>'+
            '<div style="display:flex;gap:1.5rem;flex-wrap:wrap">'+
              '<div style="text-align:right"><div style="font-size:10px;color:var(--text4);text-transform:uppercase;letter-spacing:.04em">Gesamtkosten</div><div style="font-size:16px;font-weight:700;color:var(--text)">'+fmt(totalCostUSD,'USD')+'</div></div>'+
              '<div style="text-align:right"><div style="font-size:10px;color:var(--text4);text-transform:uppercase;letter-spacing:.04em">Eff. Jahreszins</div><div style="font-size:16px;font-weight:700;color:'+color+'">'+effRate.toFixed(2)+'%</div></div>'+
            '</div>'+
          '</div>';

          /* Summary tiles */
          html+='<div class="mg" style="margin-bottom:.75rem">'+
            '<div class="mc"><span class="mc-lbl">Kumulierter fälliger Betrag</span><span class="mc-val">'+fmt(totalDueUSD,'USD')+'</span><span class="mc-sub">Kapital + alle Zinsen</span></div>'+
            '<div class="mc"><span class="mc-lbl">Zinsen gesamt</span><span class="mc-val">'+fmt(totalInterestUSD,'USD')+'</span></div>'+
            '<div class="mc"><span class="mc-lbl">Gebühren gesamt</span><span class="mc-val">'+(totalFeeBtc?totalFeeBtc.toFixed(6)+' BTC':'—')+'</span>'+(totalFeeUSD?'<span class="mc-sub">≈ '+fmt(totalFeeUSD,'USD')+'</span>':'')+'</div>'+
            '<div class="mc"><span class="mc-lbl">Ø Zinssatz (gewichtet)</span><span class="mc-val">'+avgRate.toFixed(2)+'%</span></div>'+
            '<div class="mc"><span class="mc-lbl">Ø Kreditbetrag</span><span class="mc-val">'+fmt(avgAmount,'USD')+'</span></div>'+
          '</div>';

          /* Loan table */
          html+='<div class="ovx"><table class="loans-table"><thead><tr>'+
            '<th>#</th><th>Bezeichnung</th><th>Status</th><th>Betrag</th>'+
            '<th>Zinssatz</th><th>Laufzeit</th><th>Start</th><th>Fälligkeit</th>'+
            '<th>Zinsen</th><th>Fälliger Betrag</th><th>Gebühr</th><th>Gesamtkosten</th>'+
            '<th>Break-even BTC</th>'+
          '</tr></thead><tbody>';
          members.forEach(function(l,mi){
            var iUSD=intU(l),fUSD=feeU(l),costUSD=iUSD+fUSD,dueUSD=toU(l.amount,l.c)+iUSD;
            var end=aM(l.start,l.term).toLocaleDateString('de-CH');
            var isActive=l.status==='active';
            var lBtcStart=l.btcStart||R.BTC;
            var lColBtc=l.col||0;
            var lBep=lColBtc>0?(lBtcStart+costUSD/lColBtc):null;
            html+='<tr>'+
              '<td style="color:var(--text4);font-size:11px">'+(mi+1)+'</td>'+
              '<td class="tbl-name">'+l.name+'</td>'+
              '<td><span class="badge '+(isActive?'ba':'bc')+'">'+(isActive?'Aktiv':'Abg.')+'</span></td>'+
              '<td class="amt">'+fmt(l.amount,l.c)+'</td>'+
              '<td>'+l.rate+'%</td>'+
              '<td>'+l.term+' Mt.</td>'+
              '<td>'+new Date(l.start).toLocaleDateString('de-CH')+'</td>'+
              '<td>'+end+'</td>'+
              '<td class="amt">'+fmt(iUSD,'USD')+'</td>'+
              '<td class="amt" style="font-weight:600">'+fmt(dueUSD,'USD')+'</td>'+
              '<td class="amt">'+(l.feeBtc?l.feeBtc.toFixed(6)+' BTC':'—')+'</td>'+
              '<td class="amt" style="font-weight:600">'+fmt(costUSD,'USD')+'</td>'+
              (lBep?'<td class="amt" style="font-size:11px">$'+Math.round(lBep).toLocaleString('de-CH')+'</td>':'<td class="amt" style="color:var(--text4)">—</td>')+
            '</tr>';
          });
          /* Totals row */
          /* Break-even total: first loan's btcStart + totalCostUSD / totalColBtc */
          var totalColBtc=members.reduce(function(s,l){return s+(l.col||0);},0);
          var firstBtcStart=members[0].btcStart||R.BTC;
          var totalBep=totalColBtc>0?(firstBtcStart+totalCostUSD/totalColBtc):null;
          html+='<tr style="background:var(--bg2);font-weight:700;border-top:2px solid var(--border)">'+
            '<td colspan="8" style="font-size:12px;color:var(--text4)">Total</td>'+
            '<td class="amt">'+fmt(totalInterestUSD,'USD')+'</td>'+
            '<td class="amt" style="color:'+color+'">'+fmt(totalDueUSD,'USD')+'</td>'+
            '<td class="amt">'+(totalFeeBtc?totalFeeBtc.toFixed(6)+' BTC':'—')+'</td>'+
            '<td class="amt" style="color:'+color+'">'+fmt(totalCostUSD,'USD')+'</td>'+
            (totalBep?'<td class="amt" style="font-size:11px;color:'+color+'">$'+Math.round(totalBep).toLocaleString('de-CH')+'</td>':'<td class="amt" style="color:var(--text4)">—</td>')+
          '</tr>';
          html+='</tbody></table></div>';
          html+='</div>';
        });

        /* Standalone loans hint */
        if(standalone.length){
          html+='<div class="card" style="background:var(--bg2);border:1px dashed var(--border)">'+
            '<span class="mc-lbl" style="margin-bottom:.4rem;display:block">'+standalone.length+' Kredit'+(standalone.length!==1?'e':'')+' ohne Roll-Over-Kette</span>'+
            '<div style="display:flex;flex-wrap:wrap;gap:.4rem">'+
            standalone.map(function(l){
              return '<span style="font-size:12px;background:var(--bg3);border-radius:6px;padding:2px 8px;color:var(--text3)">'+l.name+'</span>';
            }).join('')+
            '</div>'+
          '</div>';
        }

        el.innerHTML='<span class="sh">Roll-Over-Ketten</span>'+html;
      },

      sx:function(){
        var el=g('sx-content');if(!el)return;
        if(!loans.length){
          el.innerHTML='<div class="empty" style="padding:2rem;text-align:center">Noch keine Kredite vorhanden. Statistiken werden nach dem Erfassen von Krediten angezeigt.</div>';
          return;
        }
        var act=loans.filter(function(l){return l.status==='active';});
        var clo=loans.filter(function(l){return l.status==='closed';});
        var today=new Date();

        function tile(lbl,val,sub,color){
          return '<div class="mc"><span class="mc-lbl">'+lbl+'</span>'+
            '<span class="mc-val"'+(color?' style="color:'+color+'"':'')+'>'+val+'</span>'+
            (sub?'<span class="mc-sub">'+sub+'</span>':'')+
          '</div>';
        }
        function section(title){
          return '<span class="sh" style="display:block;">'+title+'</span><div class="mg">';
        }

        /* ── Portfolio ── */
        var tU=loans.reduce(function(s,l){return s+toU(l.amount,l.c);},0);
        var aU=act.reduce(function(s,l){return s+toU(l.amount,l.c);},0);
        var weightedRate=aU>0?act.reduce(function(s,l){return s+l.rate*toU(l.amount,l.c);},0)/aU:0;
        var totalInterestPaid=clo.reduce(function(s,l){return s+intU(l);},0);
        var totalInterestOut=act.reduce(function(s,l){return s+intU(l);},0);
        var totalFeePaid=loans.reduce(function(s,l){return s+feeU(l);},0);
        var totalFeeOutBtc=0; // not used anymore
        var totalFeePaidBtc=loans.reduce(function(s,l){return s+(l.feeBtc||0);},0);
        var totalFeeOut=0; // fees are always paid upfront
        var avgAmt=loans.length?tU/loans.length:0;

        /* ── Collateral & Risiko ── */
        var aC=act.reduce(function(s,l){return s+l.col;},0);
        var allC=loans.reduce(function(s,l){return s+l.col;},0);
        var ltvArr=act.filter(function(l){return l.col>0;}).map(function(l){
          var due=toU(l.amount,l.c)+intU(l);
          var mc1Price=due/(0.73*l.col);
          return {name:l.name,ltv:due/(l.col*R.BTC)*100,puffer:((R.BTC-mc1Price)/R.BTC)*100};
        });
        var avgLtv=ltvArr.length?ltvArr.reduce(function(s,x){return s+x.ltv;},0)/ltvArr.length:0;
        var maxLtv=ltvArr.length?ltvArr.reduce(function(a,b){return a.ltv>b.ltv?a:b;}):null;
        var minLtv=ltvArr.length?ltvArr.reduce(function(a,b){return a.ltv<b.ltv?a:b;}):null;
        var avgPuffer=ltvArr.length?ltvArr.reduce(function(s,x){return s+x.puffer;},0)/ltvArr.length:0;

        /* ── Zeit & Fälligkeiten ── */
        var thisYear=today.getFullYear();
        var dueThisYear=loans.filter(function(l){return aM(l.start,l.term).getFullYear()===thisYear;}).length;
        var dueNextYear=loans.filter(function(l){return aM(l.start,l.term).getFullYear()===thisYear+1;}).length;
        var dueIn2Years=loans.filter(function(l){return aM(l.start,l.term).getFullYear()===thisYear+2;}).length;
        var due7=loans.filter(function(l){var d=(aM(l.start,l.term)-today)/86400000;return d>=0&&d<=7;}).length;
        var due14=loans.filter(function(l){var d=(aM(l.start,l.term)-today)/86400000;return d>=0&&d<=14;}).length;
        var due30=loans.filter(function(l){var d=(aM(l.start,l.term)-today)/86400000;return d>=0&&d<=30;}).length;
        var due90=loans.filter(function(l){var d=(aM(l.start,l.term)-today)/86400000;return d>=0&&d<=90;}).length;
        var due180=loans.filter(function(l){var d=(aM(l.start,l.term)-today)/86400000;return d>=0&&d<=180;}).length;
        var due365=loans.filter(function(l){var d=(aM(l.start,l.term)-today)/86400000;return d>=0&&d<=365;}).length;
        /* Colour helper: colour based on the bucket's own urgency */
        function dueColor(n,days){
          if(!n)return null;
          if(days<=7) return'var(--err)';
          if(days<=14)return'#ea580c';
          if(days<=30)return'var(--warn)';
          if(days<=90)return'var(--text3)';
          return null;                     /* >90d: no special colour */
        }
        var avgTerm=loans.length?loans.reduce(function(s,l){return s+l.term;},0)/loans.length:0;
        var dates=loans.map(function(l){return new Date(l.start);}).filter(function(x){return !isNaN(x);});
        var oldest=dates.length?new Date(Math.min.apply(null,dates)):null;
        var newest=dates.length?new Date(Math.max.apply(null,dates)):null;

        /* ── Effizienz ── */
        var byRate=act.slice().sort(function(a,b){return a.rate-b.rate;});
        var cheapest=byRate[0]||null;
        var priciest=byRate[byRate.length-1]||null;
        var allByRate=loans.slice().sort(function(a,b){return a.rate-b.rate;});
        var monthlyPer100=aU>0?act.reduce(function(s,l){return s+toU(l.amount*(l.rate/100)/12,l.c);},0)/aU*100:0;
        var zinsBelastung=aU>0?totalInterestOut/aU*100:0;
        /* Effektiver Jahreszins: volumengewichtet, aktive Kredite */
        var effJahreszins=aU>0?act.reduce(function(s,l){
          var annRate=l.term>0?(intU(l)/toU(l.amount,l.c))*(12/l.term)*100:l.rate;
          return s+annRate*toU(l.amount,l.c);
        },0)/aU:0;
        /* Effektiver Jahreszins alle Kredite */
        var effJahreszinsAll=tU>0?loans.reduce(function(s,l){
          var annRate=l.term>0?(intU(l)/toU(l.amount,l.c))*(12/l.term)*100:l.rate;
          return s+annRate*toU(l.amount,l.c);
        },0)/tU:0;
        /* Gewichteter Zinssatz abgeschlossen */
        var cloU=clo.reduce(function(s,l){return s+toU(l.amount,l.c);},0);
        var weightedRateClo=cloU>0?clo.reduce(function(s,l){return s+l.rate*toU(l.amount,l.c);},0)/cloU:0;
        var weightedRateAll=tU>0?loans.reduce(function(s,l){return s+l.rate*toU(l.amount,l.c);},0)/tU:0;
        /* Abgeschlossene Kredite */
        var cloVolume=cloU;
        var avgTermClo=clo.length?clo.reduce(function(s,l){return s+l.term;},0)/clo.length:0;
        var avgTermAct=act.length?act.reduce(function(s,l){return s+l.term;},0)/act.length:0;
        var avgTerm=loans.length?loans.reduce(function(s,l){return s+l.term;},0)/loans.length:0;
        /* Ø Kreditbetrag */
        var avgAmtAct=act.length?aU/act.length:0;
        var avgAmtClo=clo.length?cloVolume/clo.length:0;
        /* Gesamte Zinsen effektiv (aufgelaufen) */
        var totalInterestEver=clo.reduce(function(s,l){return s+intU(l);},0)+act.reduce(function(s,l){
          var start=new Date(l.start),end=aM(l.start,l.term),now5=new Date();
          var elapsed=Math.max(0,Math.min(now5-start,end-start));
          var total=Math.max(end-start,1);
          return s+intU(l)*(elapsed/total);
        },0);
        /* Zinsen/Volumen alle */
        var zinsBelastungAll=tU>0?(totalInterestPaid+totalInterestOut)/tU*100:0;
        var zinsBelastungClo=cloVolume>0?totalInterestPaid/cloVolume*100:0;

        /* ── HTML ── */
        var html='';
        var dash='\u2013';
        var visCcys=(['EUR','CHF','USD','USDT','USDC','CZK','PLN']).filter(function(c){return visC(c);});

        function sub3(a,c,t){/* aktiv · abgeschlossen · alle */
          var parts=[];
          if(a!==null)parts.push('<b style="color:var(--ok)">Aktiv</b> '+a);
          if(c!==null)parts.push('<b style="color:var(--text3)">Abg.</b> '+c);
          if(t!==null)parts.push('<b>Alle</b> '+t);
          return '<span style="font-size:12px;line-height:1.6">'+parts.join(' \u00b7 ')+'</span>';
        }
        /* Per-currency breakdown: fn(loanArr, ccy) → value string */
        function subCcy(fnAct,fnClo,fnAll){
          if(!visCcys.length)return '';
          var parts=visCcys.map(function(c){
            var a=fnAct?fnAct(c):null;
            var cl=fnClo?fnClo(c):null;
            var al=fnAll?fnAll(c):null;
            var segs=[];
            if(a!==null)segs.push('<span style="color:var(--ok)">'+a+'</span>');
            if(cl!==null)segs.push('<span style="color:var(--text3)">'+cl+'</span>');
            if(al!==null)segs.push(al);
            return '<b>'+c+'</b> '+segs.join(' / ');
          });
          return '<span style="font-size:12px;line-height:1.8;display:block;margin-top:2px">'+parts.join('<br>')+'</span>';
        }
        /* Helpers to aggregate by currency */
        function volByCcy(arr,c){return arr.filter(function(l){return l.c===c;}).reduce(function(s,l){return s+l.amount;},0);}
        function dueByCcyFn(arr,c){return arr.filter(function(l){return l.c===c;}).reduce(function(s,l){return s+l.amount+l.amount*(l.rate/100)*(l.term/12);},0);}
        function intByCcy(arr,c){return arr.filter(function(l){return l.c===c;}).reduce(function(s,l){return s+l.amount*(l.rate/100)*(l.term/12);},0);}
        function avgAmtByCcy(arr,c){var ls=arr.filter(function(l){return l.c===c;});return ls.length?ls.reduce(function(s,l){return s+l.amount;},0)/ls.length:null;}
        function weightedRateByCcy(arr,c){
          var ls=arr.filter(function(l){return l.c===c;});
          var vol=ls.reduce(function(s,l){return s+l.amount;},0);
          return vol>0?ls.reduce(function(s,l){return s+l.rate*l.amount;},0)/vol:null;
        }

        html+=section('Portfolio-\u00dcbersicht');
        html+=tile('Kredite',loans.length+'',sub3(act.length+'',clo.length+'',loans.length+''));
        html+='<div class="mc"><span class="mc-lbl">Volumen (Kreditbetrag)</span><span class="mc-val">'+fmt(tU,'USD')+'</span>'+
          sub3(fmt(aU,'USD'),clo.length?fmt(cloVolume,'USD'):dash,fmt(tU,'USD'))+
          subCcy(
            function(c){var v=volByCcy(act,c);return v?fmt(v,c):null;},
            function(c){var v=volByCcy(clo,c);return clo.length&&v?fmt(v,c):null;},
            function(c){var v=volByCcy(loans,c);return v?fmt(v,c):null;}
          )+'</div>';
        var tDue=loans.reduce(function(s,l){return s+toU(l.amount,l.c)+intU(l);},0);
        var aDueS=act.reduce(function(s,l){return s+toU(l.amount,l.c)+intU(l);},0);
        var cloDue=clo.reduce(function(s,l){return s+toU(l.amount,l.c)+intU(l);},0);
        html+='<div class="mc"><span class="mc-lbl">Volumen (Schulden)</span><span class="mc-val">'+fmt(tDue,'USD')+'</span>'+
          sub3(fmt(aDueS,'USD'),clo.length?fmt(cloDue,'USD'):dash,fmt(tDue,'USD'))+
          subCcy(
            function(c){var v=dueByCcyFn(act,c);return v?fmt(v,c):null;},
            function(c){var v=dueByCcyFn(clo,c);return clo.length&&v?fmt(v,c):null;},
            function(c){var v=dueByCcyFn(loans,c);return v?fmt(v,c):null;}
          )+'</div>';
        html+='<div class="mc"><span class="mc-lbl">\u00d8 Zinssatz (gewichtet)</span><span class="mc-val">'+weightedRateAll.toFixed(2)+'%</span>'+
          sub3(weightedRate.toFixed(2)+'%',clo.length?weightedRateClo.toFixed(2)+'%':dash,weightedRateAll.toFixed(2)+'%')+
          subCcy(
            function(c){var v=weightedRateByCcy(act,c);return v!==null?v.toFixed(2)+'%':null;},
            function(c){var v=weightedRateByCcy(clo,c);return clo.length&&v!==null?v.toFixed(2)+'%':null;},
            function(c){var v=weightedRateByCcy(loans,c);return v!==null?v.toFixed(2)+'%':null;}
          )+'</div>';
        html+='<div class="mc"><span class="mc-lbl">\u00d8 Kredith\u00f6he</span><span class="mc-val">'+fmt(avgAmt,'USD')+'</span>'+
          sub3(act.length?fmt(avgAmtAct,'USD'):dash,clo.length?fmt(avgAmtClo,'USD'):dash,fmt(avgAmt,'USD'))+
          subCcy(
            function(c){var v=avgAmtByCcy(act,c);return v!==null?fmt(v,c):null;},
            function(c){var v=avgAmtByCcy(clo,c);return clo.length&&v!==null?fmt(v,c):null;},
            function(c){var v=avgAmtByCcy(loans,c);return v!==null?fmt(v,c):null;}
          )+'</div>';
        html+='</div>';

        html+=section('Zinsen &amp; Kosten');
        var fiatCCYs=['EUR','CHF','CZK','PLN','USD'].filter(visC);
        var feePaidGrid=cGrid(fiatCCYs.map(function(c){return {c:c,v:frU(totalFeePaid,c)};}));
        html+='<div class="mc"><span class="mc-lbl">Zinsen (bis F\u00e4lligkeit)</span><span class="mc-val">'+fmt(totalInterestOut+totalInterestPaid,'USD')+'</span>'+
          sub3(fmt(totalInterestOut,'USD'),clo.length?fmt(totalInterestPaid,'USD'):dash,fmt(totalInterestOut+totalInterestPaid,'USD'))+
          subCcy(
            function(c){var v=intByCcy(act,c);return v?fmt(v,c):null;},
            function(c){var v=intByCcy(clo,c);return clo.length&&v?fmt(v,c):null;},
            function(c){var v=intByCcy(loans,c);return v?fmt(v,c):null;}
          )+'</div>';
        html+=tile('Zinsen seit Beginn (effektiv)',fmt(totalInterestEver,'USD'),'aufgelaufene Zinsen bis heute');
        html+='<div class="mc"><span class="mc-lbl">Zinsen / Volumen</span><span class="mc-val">'+zinsBelastungAll.toFixed(1)+'%</span>'+
          sub3(zinsBelastung.toFixed(1)+'%',clo.length?zinsBelastungClo.toFixed(1)+'%':dash,zinsBelastungAll.toFixed(1)+'%')+'</div>';
        html+='<div class="mc"><span class="mc-lbl">Geb\u00fchren bezahlt (alle)</span><span class="mc-val">'+totalFeePaidBtc.toFixed(8)+' BTC</span><span class="mc-sub" style="font-size:10px;line-height:1.4">'+feePaidGrid+'</span></div>';
        html+=tile('Gesamtkosten (Zins+Geb\u00fchr)',fmt(totalInterestOut+totalFeePaid,'USD'),'aktive Kredite');
        html+='</div>';

        html+=section('Laufzeit');
        html+='<div class="mc"><span class="mc-lbl">\u00d8 Laufzeit</span><span class="mc-val">'+avgTerm.toFixed(1)+' Mt.</span>'+
          sub3(act.length?avgTermAct.toFixed(1)+' Mt.':dash,clo.length?avgTermClo.toFixed(1)+' Mt.':dash,avgTerm.toFixed(1)+' Mt.')+'</div>';
        html+=tile('\u00c4ltester Kredit',oldest?oldest.toLocaleDateString('de-CH'):dash,'Startdatum');
        html+=tile('Neuester Kredit',newest?newest.toLocaleDateString('de-CH'):dash,'Startdatum');
        html+='</div>';

        html+=section('Collateral &amp; Risiko');
        var btcCcys=['USD','EUR','CHF','USDT','USDC','CZK','PLN'].filter(visC);
        var btcValGrid=cGrid(btcCcys.map(function(c){return {c:c,v:aC*R.BTC/(R[c]||1)};}));
        html+='<div class="mc"><span class="mc-lbl">BTC gebunden (aktiv)</span>'+
          '<span class="mc-val">'+aC.toFixed(8)+' BTC</span>'+
          '<span class="mc-sub">von '+allC.toFixed(8)+' BTC total</span>'+
          (btcValGrid?'<span class="mc-sub" style="margin-top:.35rem">'+btcValGrid+'</span>':'')+
        '</div>';
        html+=tile('\u00d8 LTV aktive Kredite',avgLtv.toFixed(1)+'%','',lc(avgLtv));
        html+=tile('H\u00f6chster LTV',maxLtv?maxLtv.ltv.toFixed(1)+'%':dash,maxLtv?maxLtv.name:'',maxLtv?lc(maxLtv.ltv):'');
        html+=tile('Niedrigster LTV',minLtv?minLtv.ltv.toFixed(1)+'%':dash,minLtv?minLtv.name:'',minLtv?lc(minLtv.ltv):'');
        html+=tile('\u00d8 Puffer bis MC1',avgPuffer.toFixed(1)+'%','bis 73% LTV-Schwelle',avgPuffer<10?'#dc2626':avgPuffer<20?'#d97706':'#16a34a');
        html+='</div>';

        html+=section('F\u00e4lligkeiten');
        html+=tile('F\u00e4llig in 7 Tagen',due7+' Kredit(e)','kumulativ',dueColor(due7,7));
        html+=tile('F\u00e4llig in 14 Tagen',due14+' Kredit(e)','kumulativ',dueColor(due14,14));
        html+=tile('F\u00e4llig in 30 Tagen',due30+' Kredit(e)','kumulativ',dueColor(due30,30));
        html+=tile('F\u00e4llig in 90 Tagen',due90+' Kredit(e)','kumulativ',dueColor(due90,90));
        html+=tile('F\u00e4llig in 180 Tagen',due180+' Kredit(e)','kumulativ',dueColor(due180,180));
        html+=tile('F\u00e4llig in 365 Tagen',due365+' Kredit(e)','kumulativ',dueColor(due365,365));
        html+=tile('F\u00e4llig '+thisYear,dueThisYear+' Kredit(e)','in diesem Kalenderjahr');
        html+=tile('F\u00e4llig '+(thisYear+1),dueNextYear+' Kredit(e)','im n\u00e4chsten Kalenderjahr');
        html+=tile('F\u00e4llig '+(thisYear+2),dueIn2Years+' Kredit(e)','in zwei Jahren');
        html+='</div>';

        /* ── Break-even ── */
        var beLoans=loans.filter(function(l){return l.btcStart&&l.btcStart>0&&l.col>0;});
        /* Simple average: mean of individual break-even prices */
        var beAvg=beLoans.length?beLoans.reduce(function(s,l){
          var bep=l.btcStart*(dueU(l)/toU(l.amount,l.c));
          return s+bep;
        },0)/beLoans.length:null;
        /* Weighted by loan volume (USD): each bep weighted by loan amount in USD */
        var beWNum=beLoans.reduce(function(s,l){
          var lU=toU(l.amount,l.c);
          var bep=l.btcStart*(dueU(l)/lU);
          return s+bep*lU;
        },0);
        var beWDen=beLoans.reduce(function(s,l){return s+toU(l.amount,l.c);},0);
        var beWeighted=beWDen>0?beWNum/beWDen:null;
        var beReached=beAvg!==null&&R.BTC>=beAvg;
        var beWReached=beWeighted!==null&&R.BTC>=beWeighted;

        html+=section('Effizienz');
        html+='<div class="mc"><span class="mc-lbl">Effektiver Jahreszins</span><span class="mc-val">'+effJahreszinsAll.toFixed(2)+'%</span>'+
          sub3(effJahreszins.toFixed(2)+'%',null,effJahreszinsAll.toFixed(2)+'%')+'</div>';
        html+=tile('G\u00fcnstigster Kredit',cheapest?cheapest.rate.toFixed(2)+'%':dash,cheapest?cheapest.name:'');
        html+=tile('Teuerster Kredit',priciest?priciest.rate.toFixed(2)+'%':dash,priciest?priciest.name:'');
        if(beAvg!==null){
          html+='<div class="mc"><span class="mc-lbl">Break-even \u00d8 (einfach)</span>'+
            '<span class="mc-val" style="color:'+(beReached?'var(--ok)':'var(--warn)')+'">$'+Math.round(beAvg).toLocaleString('de-CH')+'</span>'+
            '<span class="mc-sub" style="color:'+(beReached?'var(--ok)':'var(--warn)')+'">'+
              (beReached?'\u2713 Erreicht — Kredite haben sich gelohnt':'\u2715 Noch nicht erreicht')+
            '</span>'+
            '<span class="mc-sub">Aktuell $'+Math.round(R.BTC).toLocaleString('de-CH')+
              (beReached?' · \u25b2 $'+(Math.round(R.BTC-beAvg)).toLocaleString('de-CH')+' \u00fcber Break-even':
                         ' · noch $'+(Math.round(beAvg-R.BTC)).toLocaleString('de-CH')+' bis Break-even')+
            '</span>'+
            '<span class="mc-sub" style="color:var(--text4)">Mittelwert der einzelnen Break-even-Preise</span>'+
          '</div>';
        }
        if(beWeighted!==null){
          html+='<div class="mc"><span class="mc-lbl">Break-even gewichtet</span>'+
            '<span class="mc-val" style="color:'+(beWReached?'var(--ok)':'var(--warn)')+'">$'+Math.round(beWeighted).toLocaleString('de-CH')+'</span>'+
            '<span class="mc-sub" style="color:'+(beWReached?'var(--ok)':'var(--warn)')+'">'+
              (beWReached?'\u2713 Erreicht — Kredite haben sich gelohnt':'\u2715 Noch nicht erreicht')+
            '</span>'+
            '<span class="mc-sub">Aktuell $'+Math.round(R.BTC).toLocaleString('de-CH')+
              (beWReached?' · \u25b2 $'+(Math.round(R.BTC-beWeighted)).toLocaleString('de-CH')+' \u00fcber Break-even':
                          ' · noch $'+(Math.round(beWeighted-R.BTC)).toLocaleString('de-CH')+' bis Break-even')+
            '</span>'+
            '<span class="mc-sub" style="color:var(--text4)">Gewichtet nach Kreditbetrag in USD</span>'+
          '</div>';
        }
        if(!beLoans.length){
          html+=tile('Break-even',dash,'Kein BTC-Startpreis hinterlegt','var(--text4)');
        }
        html+='</div>';

        el.innerHTML=html;
      },

      se:function(){
        var el=g('ccy-toggles');if(!el)return;
        el.innerHTML=ALL_CCYS.map(function(c){
          var on=visC(c);
          return '<label style="display:inline-flex;align-items:center;gap:6px;padding:6px 12px;border:1px solid '+(on?'var(--accent)':'var(--border)')+';border-radius:20px;cursor:pointer;background:'+(on?'var(--accent-bg)':'var(--bg)')+';font-size:13px;color:var(--text)">'+
            '<input type="checkbox" data-c="'+c+'" '+(on?'checked':'')+' style="accent-color:var(--accent);width:14px;height:14px">'+c+'</label>';
        }).join('');
        /* Populate display/nav settings */
        var st=g('se-default-tab');if(st){for(var i=0;i<st.options.length;i++){if(st.options[i].value===(cfg.defaultTab||'ov')){st.selectedIndex=i;break;}}}
        var sv=g('se-default-view');if(sv){for(var i=0;i<sv.options.length;i++){if(sv.options[i].value===(cfg.defaultView||'grid')){sv.selectedIndex=i;break;}}}
        var sc=g('se-default-ccy');if(sc){for(var i=0;i<sc.options.length;i++){if(sc.options[i].value===(cfg.defaultCcy||'EUR')){sc.selectedIndex=i;break;}}}
        var scm=g('se-color-mode');if(scm){scm.value=(cfg.darkMode||localStorage.getItem('ffd_dark')==='1')?'dark':'light';}
        var shbe=g('se-hide-breakeven');if(shbe)shbe.checked=!!(cfg.hideBreakEven);
        /* Populate LTV thresholds */
        var sw=g('se-ltv-warn');if(sw)sw.value=cfg.ltvWarn!=null?cfg.ltvWarn:73;
        var scc=g('se-ltv-crit');if(scc)scc.value=cfg.ltvCrit!=null?cfg.ltvCrit:79;
        var sdn=g('se-ltv-danger');if(sdn)sdn.value=cfg.ltvDanger!=null?cfg.ltvDanger:86;
        var sd=g('se-ltv-display');if(sd)sd.value=cfg.ltvDisplay!=null?cfg.ltvDisplay:73;
        /* Populate countdown */
        var scd=g('se-countdown');if(scd)scd.value=cfg.countdownDays!=null?cfg.countdownDays:30;
        /* Render nav order */
        d.seNavOrderRender();
      },
      ccyAll:function(){
        document.querySelectorAll('#ccy-toggles input[type=checkbox]').forEach(function(cb){cb.checked=true;});
      },
      ccySave:function(){
        var checked=[];
        document.querySelectorAll('#ccy-toggles input[type=checkbox]').forEach(function(cb){if(cb.checked)checked.push(cb.dataset.c);});
        if(!checked.length){alert('Mindestens eine Währung auswählen.');return;}
        cfg.ccys=checked;
        saveSettings(cfg);
        /* Update CSW buttons */
        d.renderCsw();
        /* Re-render current active section */
        var at=document.querySelector('#ffd-root .nav-item.on, #ffd-root .tab.on');
        if(at){var t=at.getAttribute('onclick').match(/'([^']+)'/)[1];var fn={ov:d.ov,lo:d.loans,st:d.stress,ca:d.cal,tl:d.tl};if(fn[t])fn[t]();}
        var msg=g('ccy-saved-msg');msg.style.display='block';setTimeout(function(){msg.style.display='none';},2000);
      },
      seDisplaySave:function(){
        cfg.defaultTab=g('se-default-tab').value||'ov';
        cfg.defaultView=g('se-default-view').value||'grid';
        cfg.defaultCcy=g('se-default-ccy').value||'EUR';
        var modeEl=g('se-color-mode');
        if(modeEl){
          var wantDark=modeEl.value==='dark';
          var r=document.getElementById('ffd-root');
          if(wantDark){r.classList.add('dark');localStorage.setItem('ffd_dark','1');}
          else{r.classList.remove('dark');localStorage.setItem('ffd_dark','');}
          var db=g('dark-btn');if(db)db.textContent=wantDark?'☀':'☾';
          cfg.darkMode=wantDark;
        }
        /* Save nav order from current list state */
        cfg.navOrder=d._seNavGetOrder();
        saveSettings(cfg);
        lView=cfg.defaultView;
        d.applyNavOrder();
        var msg=g('se-display-msg');msg.style.display='inline';setTimeout(function(){msg.style.display='none';},2000);
      },
      seCardSave:function(){
        var hbe=g('se-hide-breakeven');
        cfg.hideBreakEven=hbe?hbe.checked:false;
        saveSettings(cfg);
        d.loans();
        var msg=g('se-card-msg');msg.style.display='inline';setTimeout(function(){msg.style.display='none';},2000);
      },
      seLtvSave:function(){
        var w=parseInt(g('se-ltv-warn').value);
        var c=parseInt(g('se-ltv-crit').value);
        var danger=parseInt(g('se-ltv-danger').value);
        var disp=parseInt(g('se-ltv-display').value);
        if(isNaN(w)||isNaN(c)||isNaN(danger)||isNaN(disp)){alert('Bitte gültige Zahlen eingeben.');return;}
        if(w>=c){alert('MC1-Schwelle muss kleiner als MC2-Schwelle sein.');return;}
        if(c>=danger){alert('MC2-Schwelle muss kleiner als MC3-Schwelle sein.');return;}
        cfg.ltvWarn=w;cfg.ltvCrit=c;cfg.ltvDanger=danger;cfg.ltvDisplay=disp;
        ltvThresh=disp;
        saveSettings(cfg);
        d.checkAlarms();d.ov();
        var msg=g('se-ltv-msg');msg.style.display='inline';setTimeout(function(){msg.style.display='none';},2000);
      },
      NAV_ITEMS:[
        {id:'ov', label:'Übersicht'},
        {id:'lo', label:'Meine Kredite'},
        {id:'ch', label:'Diagramme'},
        {id:'sx', label:'Statistiken'},
        {id:'ca', label:'Kalender'},
        {id:'tl', label:'Timeline'},
        {id:'ro', label:'Roll-Overs'},
        {id:'st', label:'Stress-Test'},
        {id:'to', label:'Tools'}
      ],
      applyNavOrder:function(){
        var order=cfg.navOrder||d.NAV_ITEMS.map(function(x){return x.id;});
        var sidebar=document.querySelector('#ffd-root .sidebar');
        if(!sidebar)return;
        /* Collect all nav-items (exclude settings + spacer) */
        var items=Array.from(sidebar.querySelectorAll('.nav-item:not([data-nav-fixed])'));
        var map={};
        items.forEach(function(el){
          var m=el.getAttribute('onclick').match(/'([^']+)'/);
          if(m)map[m[1]]=el;
        });
        /* Re-insert in order */
        var spacer=sidebar.querySelector('.nav-spacer');
        order.forEach(function(id){
          if(map[id])sidebar.insertBefore(map[id],spacer||null);
        });
      },
      seNavOrderRender:function(){
        var el=g('se-nav-order');if(!el)return;
        var order=cfg.navOrder||d.NAV_ITEMS.map(function(x){return x.id;});
        var labelMap={};d.NAV_ITEMS.forEach(function(x){labelMap[x.id]=x.label;});
        el.innerHTML='';
        order.forEach(function(id){
          var row=document.createElement('div');
          row.dataset.id=id;
          row.draggable=true;
          row.style.cssText='display:flex;align-items:center;gap:8px;padding:7px 10px;background:var(--bg3);border:1px solid var(--border);border-radius:8px;cursor:grab;user-select:none;font-size:13px;color:var(--text)';
          /* Handle */
          var handle=document.createElement('span');
          handle.style.cssText='color:var(--text4);cursor:grab;font-size:15px;line-height:1';
          handle.innerHTML='&#9776;';
          /* Label */
          var lbl=document.createElement('span');
          lbl.style.flex='1';
          lbl.textContent=labelMap[id]||id;
          /* Up button */
          var btnUp=document.createElement('button');
          btnUp.style.cssText='background:none;border:none;cursor:pointer;color:var(--text3);font-size:14px;padding:0 4px';
          btnUp.title='Nach oben';
          btnUp.innerHTML='&#9650;';
          btnUp.addEventListener('click',function(){d.seNavOrderMove(id,-1);});
          /* Down button */
          var btnDn=document.createElement('button');
          btnDn.style.cssText='background:none;border:none;cursor:pointer;color:var(--text3);font-size:14px;padding:0 4px';
          btnDn.title='Nach unten';
          btnDn.innerHTML='&#9660;';
          btnDn.addEventListener('click',function(){d.seNavOrderMove(id,1);});
          row.appendChild(handle);
          row.appendChild(lbl);
          row.appendChild(btnUp);
          row.appendChild(btnDn);
          /* Drag events */
          row.addEventListener('dragstart',function(e){e.dataTransfer.setData('text/plain',id);e.currentTarget.style.opacity='.4';});
          row.addEventListener('dragend',function(e){e.currentTarget.style.opacity='1';});
          row.addEventListener('dragover',function(e){e.preventDefault();row.style.borderColor='var(--accent)';});
          row.addEventListener('dragleave',function(){row.style.borderColor='var(--border)';});
          row.addEventListener('drop',function(e){
            e.preventDefault();row.style.borderColor='var(--border)';
            var fromId=e.dataTransfer.getData('text/plain');
            if(fromId===id)return;
            var cur=d._seNavGetOrder();
            var fi=cur.indexOf(fromId),ti=cur.indexOf(id);
            if(fi<0||ti<0)return;
            cur.splice(fi,1);cur.splice(ti,0,fromId);
            cfg.navOrder=cur;
            d.seNavOrderRender();
          });
          el.appendChild(row);
        });
      },
      _seNavGetOrder:function(){
        var rows=document.querySelectorAll('#se-nav-order [data-id]');
        return Array.from(rows).map(function(r){return r.dataset.id;});
      },
      seNavOrderMove:function(id,dir){
        var order=d._seNavGetOrder();
        var i=order.indexOf(id);
        var j=i+dir;
        if(j<0||j>=order.length)return;
        var tmp=order[i];order[i]=order[j];order[j]=tmp;
        cfg.navOrder=order;
        d.seNavOrderRender();
      },
      seNavOrderSave:function(){
        cfg.navOrder=d._seNavGetOrder();
        saveSettings(cfg);
        d.applyNavOrder();
        var msg=g('se-nav-msg');if(msg){msg.style.display='inline';setTimeout(function(){msg.style.display='none';},2000);}
      },
      seNavOrderReset:function(){
        cfg.navOrder=null;
        saveSettings(cfg);
        d.applyNavOrder();
        d.seNavOrderRender();
      },
      seCountdownSave:function(){
        var days=parseInt(g('se-countdown').value);
        if(isNaN(days)||days<1){alert('Bitte eine gültige Anzahl Tage eingeben.');return;}
        cfg.countdownDays=days;
        saveSettings(cfg);
        var msg=g('se-countdown-msg');msg.style.display='inline';setTimeout(function(){msg.style.display='none';},2000);
      },
      renderCsw:function(){
        var csw=g('debt-csw');if(!csw)return;
        var vis=['USD','EUR','CHF','USDT','USDC','CZK','PLN','BTC','SAT'].filter(visC);
        if(!vis.length)return;
        var cur=dCcy;if(vis.indexOf(cur)<0){cur=vis[0];dCcy=cur;}
        csw.innerHTML=vis.map(function(c){return '<button class="cb'+(c===cur?' on':'')+'" onclick="d.ccy(\'' +c+ '\',this)">'+c+'</button>';}).join('');
      },
      tl:function(){
        if(!loans.length){
          g('tl-list').innerHTML='<div class="empty" style="padding:2rem;text-align:center">Noch keine Kredite vorhanden. Die Timeline wird nach dem Erfassen von Krediten angezeigt.</div>';
          return;
        }
        var sorted=loans.slice().sort(function(a,b){return aM(b.start,b.term)-aM(a.start,a.term);});
        g('tl-list').innerHTML='<div class="tl">'+sorted.map(function(l){
          var dl=dL(l.start,l.term),end=aM(l.start,l.term).toLocaleDateString('de-CH'),dot=l.status==='closed'?'done':dl<30?'soon':'',lU=toU(l.amount,l.c);
          return '<div class="ti"><div class="dot '+dot+'"></div>'+
            '<span class="tdate">'+new Date(l.start).toLocaleDateString('de-CH')+' → '+end+'</span>'+
            '<span class="tlabel">'+l.name+' <span class="badge '+(l.status==='active'?'ba':'bc')+'" style="margin-left:6px">'+(l.status==='active'?'Aktiv':'Abgeschlossen')+'</span></span>'+
            '<span class="tsub amt">'+fmt(l.amount,l.c)+' · '+l.rate+'% · '+l.term+' Mo'+(l.status==='active'&&dl>0?' · noch <b>'+dl+' Tage</b>':'')+'</span>'+
            '<span class="note" style="margin-top:2px">= '+fmt(lU,'USD')+' / '+fmt(frU(lU,'CHF'),'CHF')+' / '+fmt(frU(lU,'EUR'),'EUR')+'</span></div>';
        }).join('')+'</div>';
        if(typeof Chart==='undefined'){console.warn('[tl] Chart.js not yet loaded — charts deferred to init()');return;}
        setTimeout(function(){
          d.debtChart(dCcy);
          var _tlCs=getComputedStyle(document.getElementById('ffd-root'));
          var chGridColor=_tlCs.getPropertyValue('--border').trim();
          var chTextColor=_tlCs.getPropertyValue('--text3').trim();
          var act=loans.filter(function(l){return l.status==='active';});
          if(chI){chI.destroy();chI=null;}
          var c2=g('int-chart');
          if(c2&&act.length)chI=new Chart(c2,{type:'bar',
            data:{labels:act.map(function(l){return l.name;}),datasets:[{data:act.map(function(l){return Math.round(intU(l));}),backgroundColor:'#FDBA74',borderColor:'#F97316',borderWidth:1,borderRadius:4}]},
            options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false}},scales:{y:{ticks:{color:chTextColor,callback:function(v){return '$'+v.toLocaleString('de-CH');}},grid:{color:chGridColor}},x:{ticks:{color:chTextColor},grid:{display:false}}}}
          });
        },120);
      }
    };

    function init(){
      /* Restore dark mode — ffd_dark takes precedence, fallback to cfg.darkMode */
      if(localStorage.getItem('ffd_dark')==='1'||cfg.darkMode){document.getElementById('ffd-root').classList.add('dark');var db=g('dark-btn');if(db)db.textContent='☀';if(cfg.darkMode)localStorage.setItem('ffd_dark','1');}
      /* Restore sidebar state */
      if(localStorage.getItem('ffd_sidebar_collapsed')==='1'){
        var sb=document.querySelector('#ffd-root .sidebar');var mn=document.querySelector('#ffd-root .main');
        if(sb){sb.classList.add('collapsed');}if(mn){mn.classList.add('sidebar-collapsed');mn.style.marginLeft='52px';}
      }
      /* Restore hide-amounts */
      if(cfg.hideAmounts){document.getElementById('ffd-root').classList.add('hide-amounts');}
      /* Apply default view button state */
      (function(){var gb=g('view-grid-btn'),lb=g('view-list-btn');if(lView==='list'){if(gb)gb.classList.remove('on');if(lb)lb.classList.add('on');}})();
      syncStatus();save();pills();d.renderCsw();d.checkAlarms();d.extPopulate();d.vorInit();d.plInit();d.ov();
      /* Re-render active tab now that Chart.js is available — fixes tabs that bail early on typeof Chart */
      (function(){
        var at=document.querySelector('#ffd-root .tab.on, #ffd-root .nav-item.on');
        if(at){var m=at.getAttribute('onclick').match(/'([^']+)'/);if(m){var t=m[1];var fn={ch:d.ch,st:d.stress,tl:d.tl,sx:d.sx,lo:d.loans,ca:d.cal};if(fn[t])fn[t]();}}
      })();
      d.refreshBtc();
    }

    d.refreshBtc=async function(){
      function showCgRateLimit(){var rl=g('cg-ratelimit-msg');if(rl)rl.style.display='inline';}
      function hideCgRateLimit(){var rl=g('cg-ratelimit-msg');if(rl)rl.style.display='none';}
      var btn=g('btc-refresh-btn');
      if(btn){btn.disabled=true;btn.textContent='⟳';}
      try{
        var res=await fetch('https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd,eur,chf,pln&include_24hr_change=true');
        console.log('[CoinGecko] HTTP status:', res.status);
        var data=await res.json();
        console.log('[CoinGecko] Response:', JSON.stringify(data).slice(0,200));
        if(data&&data.bitcoin&&data.bitcoin.usd){
          liveBtc=data.bitcoin.usd;R.BTC=data.bitcoin.usd;R.SAT=data.bitcoin.usd/1e8;
          if(data.bitcoin.eur)R.EUR=data.bitcoin.usd/data.bitcoin.eur;
          if(data.bitcoin.chf)R.CHF=data.bitcoin.usd/data.bitcoin.chf;
          if(data.bitcoin.pln)R.PLN=data.bitcoin.usd/data.bitcoin.pln;
          if(data.bitcoin.usd_24h_change!=null)btc24hChange=data.bitcoin.usd_24h_change;
          console.log('[CoinGecko] BTC price loaded:', liveBtc);
        } else {
          console.warn('[CoinGecko] Unexpected response structure — no bitcoin.usd found');
        }
      }catch(e){console.error('[CoinGecko] Fetch error:', e);}
      if(!liveBtc){showCgRateLimit();}else{hideCgRateLimit();}
      pills();d.ov();d.checkAlarms();d.vorFillAll();d.nachPopulate();d.nlpPopulate();d.se2Populate();d.gvlPopulate();d.updateHdrStats();
      (function(){var at=document.querySelector('#ffd-root .tab.on, #ffd-root .nav-item.on');if(at){var m=at.getAttribute('onclick').match(/'([^']+)'/);if(m){var t=m[1];var fn={tl:d.tl,ch:d.ch,sx:d.sx,st:d.stress};if(fn[t])fn[t]();}}})();
      setTimeout(function(){d.prefetchHistPrices();},3000);
      if(btn){btn.textContent='↻';btn.disabled=false;}
    };

    if(typeof Chart!=='undefined'){
      console.log('[init] Chart.js already loaded, calling init()');
      init();
      if(typeof ChartDataLabels==='undefined'){
        var dl2=document.createElement('script');
        dl2.src='https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js';
        dl2.onload=function(){console.log('[init] ChartDataLabels loaded');};
        document.head.appendChild(dl2);
      }
    }
    else{
      var s=document.createElement('script');s.src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js';
      s.onload=function(){
        console.log('[init] Chart.js loaded, calling init()');
        init();
        var dl=document.createElement('script');
        dl.src='https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js';
        dl.onload=function(){console.log('[init] ChartDataLabels loaded');};
        document.head.appendChild(dl);
      };document.head.appendChild(s);
    }
    /* Run immediately so alarm banner, pills and overview show on first paint regardless of Chart.js */
    try{syncStatus();pills();d.renderCsw();d.loans();d.checkAlarms();d.ov();}catch(e){console.error('[startup] Fehler beim initialen Render:', e);}
    try{d.updateHdrStats();}catch(e){console.error('[startup] Fehler in updateHdrStats:', e);}
    try{if(cfg.navOrder)d.applyNavOrder();}catch(e){console.error('[startup] Fehler in applyNavOrder:', e);}
    /* Activate tab from URL hash on load, fallback to cfg.defaultTab */
    (function(){
      var validTabs=['ov','lo','to','st','ca','tl','ch','sx','se','ro'];
      var hash=(location.hash||'').replace('#','');
      var target=hash&&validTabs.indexOf(hash)>=0?hash:(cfg.defaultTab||'ov');
      if(target!=='ov'){
        /* Find the nav-item whose onclick contains the target tab key */
        var btn=Array.prototype.find.call(
          document.querySelectorAll('#ffd-root .nav-item'),
          function(b){return (b.getAttribute('onclick')||'').indexOf("'"+target+"'")>=0;}
        );
        if(btn)btn.click();
      }
    })();
    })();
    </script>
  </body>
</html>
