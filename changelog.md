# Changelog — firefish-dashboard-unofficial


---


## v1.3.0 (22.03.2026)

### New Features

**Upcoming Maturities — Cumulative Debt (Overview)**
- New full-width card in the Overview below the four main cards
- Eight time windows: 7d, 14d, 30d, 60d, 90d, 180d, 1 year, 2 years
- Main value in USD; sub-line shows other active currencies
- Colour-coded: red ≤ 7 days, yellow ≤ 14 days
- Calculation: principal + interest only (no fees)

**Break-even BTC Price in Roll-Over Simulation**
- New column in the simulation table showing the BTC price at which collateral appreciation covers all costs (interest + fees) for each roll-over
- Total row shows the break-even across the entire chain, highlighted in accent colour

**Break-even BTC Price in Roll-Overs Tab**
- Same column added to the per-loan detail table in the Roll-Overs tab
- Per loan: `btcStart + costUSD / collateralBTC`; falls back to current BTC price if no start price is stored
- Total row uses the first loan's start price and total collateral across the chain

**Break-even BTC in Header Stats Bar**
- New stat showing portfolio-wide break-even BTC price (all loans, active and closed)
- Displays distance in % (green = above break-even, red = below) and the exact price
- Tooltip lists all loans individually with their break-even price and distance
- Active loans marked with ●, closed loans with ○

**Liquidation Price in Overview Risk Card**
- New rightmost tile «Next Liq. Price» in the Risk card
- Shows the nearest liquidation price (95% LTV) across all active loans with collateral
- Colour-coded by distance: red < 5%, yellow < 15%
- Sub-line shows distance in % and the loan name

### Improvements

- **Header stat «Next Maturity»**: fälliger Betrag (due amount) moved to hover tooltip, consistent with other stats
- **Header stat «Next MC»**: renamed from «Distanz MC1» to «Distanz nächster MC»; label now shows MC1/MC2/MC3/Liq. dynamically based on current LTV of the most critical loan; also shown in tooltip per loan
- **Overview Risk card «Next MC»**: label updates dynamically (MC1 → MC2 → MC3 → Liq.) as thresholds are breached; distance shown instead of «Puffer»
- **Statistics tab**: `.mc` tiles now have `border: 1px solid var(--border)` and `border-radius: 12px`
- **Upcoming Maturities grid**: 8 equal columns `repeat(8, 1fr)` — all time windows same width
- **Upcoming Maturities currency**: main value always in USD; other currencies in sub-line

### Bug Fixes

- **Alarm banner**: LTV calculation now uses principal + interest only (`toU + intU`), fees excluded — affects all thresholds in `checkAlarms` and `renderNextAction` (13 occurrences corrected)
- **Overview Risk card «Next MC»**: was always showing MC1 price regardless of current LTV; now correctly advances to next unbreached threshold
- **Overview Risk card «Next MC»**: was using `dueU()` (includes fees) for LTV calculation; corrected to `toU + intU`
- **Liquidation banner**: LTV ≥ 95% now correctly triggers «Kredit liquidiert» with separate banner state; MC3 range narrowed to 86–95%


---

 
## v1.2.0 (17.03.2026)
 
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


## v1.1.0 (17.03.2026)

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

