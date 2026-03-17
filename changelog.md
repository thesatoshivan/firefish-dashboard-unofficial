# Changelog — firefish-dashboard-unofficial


---

 
## v1.2.0
 
### New Features
 
**BTC Price History (Hybrid)**
- Hardcoded daily price array `BTC_HIST_PRICES` for Jan 2022 – Dec 2025 (~6 KB, ±$5 accuracy)
- Lookup order: localStorage → hardcoded → CoinGecko API (fallback only)
- CoinGecko is never called for loans with start dates in 2022–2025
 
**BTC Start Price Suggestion in Forms**
- When a start date is entered, a hint appears: «Rate on DD.MM.YYYY: $X'XXX [✓ Accept]»
- Applies to both the new loan form and the edit modal
- If a loan without `btcStart` is opened for editing, the suggestion appears immediately
- Error states: ⏳ Loading… / ⚠ API limit / ⚠ Rate not found
 
**Open Debt (BTC) in Header Stats Bar**
- New element shows total debt in BTC (`₿X.XXXX`)
 
**Customisable Navigation Order**
- New «Navigation Order» section in Settings → Display & Navigation
- Items can be reordered via drag & drop or ▲▼ buttons
- Applied immediately to the sidebar and saved to localStorage
- «Settings» is pinned at the bottom and cannot be moved
 
### Improvements
 
- **Time axes**: all charts with a time axis now extend to latest maturity + 2 months
- **Today marker**: red dashed vertical line in all time-axis charts (Monthly Interest, Cashflow, Debt vs. Collateral, Debt History)
- **BTC axis**: second Y-axis (right, gold) showing debt in BTC in Debt History and Debt vs. Collateral charts, using historical prices for past months
- **Header MC1 distance**: now shows price and loan name, e.g. `12.3%  ($74'500) Loan A`
- **Stress Test**: BTC price heatmap moved here from Charts tab; order: Scenarios → Heatmap → Worst-Case Simulator
- **Default nav order**: Overview → My Loans → Charts → Statistics → Calendar → Timeline → Roll-Overs → Stress Test → Tools → Settings
- **Overview**: `#ov-ltv` rendered as responsive grid (`auto-fill, minmax(340px, 1fr), gap: 1rem`)
- **List view**: Roll-Over badge shows 🔗 symbol only with «Roll-Over» tooltip; click navigates to Roll-Overs tab
- **Tool loan dropdowns**: active loans sorted ascending by maturity, closed loans descending at the bottom (all 4 dropdowns)
- **Roll-Over Simulation**: new start date field, auto-filled on loan selection
- **Effective Cost (BTC) chart**: now uses `btcHistPrice()` instead of dead `window._ffdHistPrices` code
 
### Bug Fixes
 
- Dark mode setting not saved — `cfg.darkMode` is now persisted; `se()` reads from `cfg` instead of the DOM class
- Debt vs. Collateral: debt now includes interest (was: principal only); closed loans hidden from today onwards
- Debt vs. Collateral: all 3 tooltip values now visible simultaneously (`interaction: {mode: 'index'}`)
- Axis label colours missing in Debt History and Interest Cost charts
- `btcHistPrice` error handling now distinguishes 429 / 401+403 / other errors
- `defaultCfg` on reset now includes `navOrder` — nav order is correctly restored on reset
- `se-default-tab`: Roll-Overs (`ro`) was missing as a dropdown option

 
---


## v1.1.0

### New Features

**Roll-Over Chains**
- New `chainId` field links multiple loans into a roll-over chain
- Dropdown for chain assignment in loan creation and editing (incl. amount)
- «🔗 Roll-Over» badge on loan cards with direct navigation to the tab
- New «Roll-Overs» tab with chain overview, summary tiles, detail table and effective annual rate

**Tool: Roll-Over Simulation**
- Simulates multiple consecutive roll-overs with correct compounding logic
- Fee calculated automatically (1.5% p.a. × term)
- Select an active loan to auto-fill all fields

**Tool: Future Simulation**
- Simulates collateral value and debt development at a future BTC price
- Optional target date and extension interest rate for already matured loans
- Line chart + detail table with LTV, MC1 price and net P&L

### Improvements

**Statistics: Break-even**
- Break-even average and weighted break-even added to the «Efficiency» section
- Shows whether loans were worthwhile compared to a direct sale of the BTC

**Import / Export**
- `chainId` integrated into JSON import/export and CSV export

**Mobile**
- Sidebar footer (version, links) now visible at the bottom of the page on mobile

### Bug Fixes
- Inactive tool sub-tabs were not hidden correctly

