# firefish-dashboard-unofficial

> An unofficial, self-hosted single-file dashboard for the [Firefish](https://firefish.io) Bitcoin lending platform.

Track your active and closed loans, monitor LTV ratios and collateral health, analyse break-even prices, and get a full overview of upcoming maturities — all in one portable PHP file with no external dependencies or database required.

**This project is not affiliated with or endorsed by Firefish.**

---

## Features

- **Loan overview** — track all active and closed loans with full details (amount, rate, term, collateral, status)
- **LTV monitoring** — real-time LTV per loan with configurable MC1/MC2/MC3/liquidation thresholds and colour-coded alerts
- **Collateral health** — portfolio-level collateral value, coverage ratio and margin call price
- **Break-even analysis** — calculates the BTC price at which a loan becomes profitable, with automatic historical price lookup via CoinGecko
- **Upcoming maturities** — countdown to due dates with configurable alert window
- **Multi-currency support** — EUR, CHF, CZK, PLN, USDC, USDT with live exchange rates
- **Charts & statistics** — LTV history, debt timeline, cash flow, collateral concentration, currency distribution and more
- **Stress test** — simulate BTC price drops and see which loans get margin called
- **Dark mode** — full dark/light theme with persistent preference
- **Import / Export** — JSON and CSV (Firefish statement format) with configurable merge strategies
- **No backend required** — all data is stored in browser `localStorage`; the PHP file is a single self-contained page

---

## Requirements

- A web server with PHP (any version ≥ 7.x) — or simply open the file directly in a browser
- No database, no composer, no npm

---

## Installation

1. Download `index.php`
2. Place it in any directory on your web server (or open locally in a browser)
3. Add your `logo-bitcoin.png` to the same directory (optional — used as sidebar icon)
4. Open the file in your browser and start adding loans

---

## Usage

### Adding a loan

Click **+ Kredit hinzufügen** and fill in the loan details: amount, currency, interest rate, term, start date, collateral and an optional note. The dashboard calculates all derived values automatically.

### Exchange rates

BTC/USD, EUR/USD and CHF/USD rates are fetched automatically on load. You can also override them manually at any time by editing the values directly in the header pills.

### Break-even

For each loan, you can store the BTC price at the time of borrowing. The dashboard then shows whether the current BTC price has already covered the loan costs. Historical prices can be loaded automatically via the CoinGecko public API.

### Import & Export

- **Export JSON** — saves all loans and settings to a timestamped JSON file
- **Import JSON** — restores from a previous export (merge, skip duplicates or replace)
- **Import CSV** — compatible with the official Firefish loan statement CSV export

---

## Settings

All settings are saved in `localStorage` and included in JSON exports:

| Setting | Description |
|---|---|
| Preferred currencies | Which currencies appear in conversion breakdowns |
| Default tab | Which section opens on load |
| Default loan view | Grid (cards) or list table |
| Default loan currency | Pre-selected currency for new loans |
| Colour mode | Light or dark theme |
| LTV thresholds | MC1 / MC2 / MC3 / liquidation percentages |
| Countdown window | How many days ahead to show upcoming maturities |
| Hide break-even | Hide the break-even widget on loan cards |

---

## Screenshots

<table>
<tr>
<td align="center"><strong>Overview</strong><br><img src="https://raw.githubusercontent.com/thesatoshivan/firefish-dashboard-unofficial/main/Screenshots/screenshot_uebersicht.png" width="100%"></td>
<td align="center"><strong>My Loans</strong><br><img src="https://raw.githubusercontent.com/thesatoshivan/firefish-dashboard-unofficial/main/Screenshots/screenshot_meine-kredite.png" width="100%"></td>
</tr>
<tr>
<td align="center"><strong>Charts</strong><br><img src="https://raw.githubusercontent.com/thesatoshivan/firefish-dashboard-unofficial/main/Screenshots/screenshot_diagramme.png" width="100%"></td>
<td align="center"><strong>Statistics</strong><br><img src="https://raw.githubusercontent.com/thesatoshivan/firefish-dashboard-unofficial/main/Screenshots/screenshot_statistiken.png" width="100%"></td>
</tr>
<tr>
<td align="center"><strong>Stress Test</strong><br><img src="https://raw.githubusercontent.com/thesatoshivan/firefish-dashboard-unofficial/main/Screenshots/screenshot_stress-test.png" width="100%"></td>
<td align="center"><strong>Timeline</strong><br><img src="https://raw.githubusercontent.com/thesatoshivan/firefish-dashboard-unofficial/main/Screenshots/screenshot_timeline.png" width="100%"></td>
</tr>
<tr>
<td align="center"><strong>Tools</strong><br><img src="https://raw.githubusercontent.com/thesatoshivan/firefish-dashboard-unofficial/main/Screenshots/screenshot_tools.png" width="100%"></td>
<td align="center"><strong>Calendar</strong><br><img src="https://raw.githubusercontent.com/thesatoshivan/firefish-dashboard-unofficial/main/Screenshots/screenshot_kalender.png" width="100%"></td>
</tr>
<tr>
<td align="center"><strong>Settings</strong><br><img src="https://raw.githubusercontent.com/thesatoshivan/firefish-dashboard-unofficial/main/Screenshots/screenshot_einstellungen.png" width="100%"></td>
<td></td>
</tr>
</table>

<sub>All loans shown in these screenshots are fictional and for demonstration purposes only.</sub>

---

## Disclaimer

This is an unofficial community tool. It is not connected to, affiliated with, or endorsed by Firefish. All data is stored locally in your browser — nothing is sent to any server. Use at your own risk.

---

## Author

[@TheSatoshiVan](https://x.com/TheSatoshiVan) · [GitHub](https://github.com/thesatoshivan)
