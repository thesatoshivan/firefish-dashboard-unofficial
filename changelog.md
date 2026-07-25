# Changelog — firefish-dashboard-unofficial


---


## v1.6.0 (25.07.2026)

### Improvements

- **Loans without a stored BTC start price are now marked**: without a start price the fee's fiat value and the break-even have to fall back to the current BTC price — unavoidable, but until now invisible. «Meine Kredite» shows a chip counting the affected loans, following the active filter and naming how many of them carry a fee, and the fee value on such a loan is marked with ⚠ that explains on hover that today's price was used. Loans that do have a start price show which price their fee was valued at. Note that the Firefish statement CSV contains no start price, so imported loans are affected until the price is accepted once per loan

### Bug Fixes

- **Origination fee valued at today's price**: the fee is a fixed BTC amount paid when the loan is taken out, but its fiat value was recalculated at the current BTC price, so a sunk cost drifted with the market — the same 0.005 BTC fee showed 250 at BTC 50'000 and 500 after the price doubled. It is now valued at the BTC price stored for the loan's start date, which also corrects the break-even prices, the roll-over chain totals, the statistics and the CSV export. Hovering the fee on a loan card shows which price was used
- **Liquidation price in the Vor-Kredit and Powerlaw tools**: «Aktueller Liquidationspreis», the LTV calculator, the Bitcoin reserve tool and the Powerlaw liquidation tool approximated the 95 % liquidation threshold as «×1.05» instead of «÷0.95». They reported a liquidation price 0.25 % lower than the loan cards, the alarms and the other calculators do for the same position — the direction that makes a position look safer than it is. All tools now use the same definition, verified against a live Firefish position (7'156 USD due on 0.13972794 BTC liquidates at ~53'912 USD, i.e. at exactly 95 % LTV), and the two «Kursrückgang»-sliders no longer reach past the liquidation point
- **Collateral-Nachschuss-Rechner**: the calculator worked with the loan principal only, while every LTV elsewhere in the dashboard includes the interest. For a 10'000 loan at 10 % over 12 months with 0.2 BTC collateral it reported 50.0 % where the loan card reported 55.0 %, and it consequently understated every top-up — in a tight position it even answered «✓ Kein Nachschuss nötig» when collateral was in fact missing. It now uses principal + interest, and the input is labelled «Fälliger Betrag (Kredit + Zinsen)» accordingly
- **Collateral-Nachschuss-Rechner**: a loan with no collateral yet showed no result at all, which is exactly the case where the required amount matters most; it now reports the full amount needed
- **JSON import**: a backup whose main currency was not among its own enabled currencies was restored as-is. Nothing looked wrong at first, because the display falls back to USD for a currency that is switched off — but the setting stayed in place invisibly and took over the whole dashboard the moment that currency was enabled again. The import now falls back to USD, or to the first enabled currency


---


## v1.5.0 (24.07.2026)

### New Features

**Main Currency**
- New «Hauptwährung» select in Einstellungen → Bevorzugte Währungen: pick one of the currencies you have enabled and it becomes the primary currency across the whole dashboard — header stats, Übersicht, Meine Kredite, Statistiken, Roll-Overs, Portfolio, Stress-Test, every chart axis and the four chart titles that name a currency
- The Tools calculators and the debt chart's currency buttons start on the main currency instead of always on USD
- Multi-currency breakdowns lead with the main currency; it is left out only where the headline right above already states the amount in it
- Amounts are stored and calculated in USD internally and only converted for display, so switching the main currency is lossless and can be undone at any time
- The setting is saved with the other settings and travels with JSON export and import; switching a currency off that is currently the main currency falls back to USD or the first remaining currency


---


## v1.4.0 (24.07.2026)

### New Features

**New «Portfolio» Tab (₿)**
- Shows the entire Bitcoin position, not just the loans: total stack, cold storage vs. pledged collateral, open debt, monthly interest and interest as a share of the stack
- Net worth, stack LTV, leverage factor (✓ Ungehebelt / Moderat / Hoch / ⚠ Sehr hoch) and a liquidity buffer showing how many months of interest the cold storage covers
- «MC1-Reserve» — how much BTC would be needed to bring every loan back below MC1 — and a rebalancing hint for the target LTV
- Scenario table from −50 % to +50 % BTC price with stack value, net worth and both LTVs
- Exit calculator: the BTC price at which all loans can be repaid while keeping a reserve of your choice

**Transaction Ledger (Portfolio)**
- Record BTC transactions — Kauf, Verkauf, Transfers, Mining, Gebühr — with date, amount, optional price, fee and note
- Entries can be edited and deleted; the table shows a running balance
- The BTC reserve is derived from the ledger automatically; entering a different value by hand switches it to manual, and «Aus Transaktionen übernehmen» switches it back
- Transactions are included in JSON export and import

**Alarm Banner in the Header**
- The LTV alarm moved from the Overview into the header and is now visible on every tab; long texts scroll automatically

### Improvements

- **Configurable LTV thresholds** are now respected everywhere — colour bands, MC1 prices, the calculator and heatmap labels, the statistics and Portfolio tiles, the future simulation and the worst-case simulator used fixed 73/79/86 regardless of the settings
- **CSV import** handles quoted fields, both `,` and `;` as separator, and thousands separators — an amount like `10.000,50` was previously imported as 10
- **CSV export** can be imported again; name, fee, term, roll-over chain and BTC start price survive the round-trip
- **Navigation order**: entries missing from a saved custom order (such as the new Portfolio tab) are inserted instead of disappearing
- **Historic prices** are retried automatically when CoinGecko's rate limit is hit, and are fetched once per session instead of on every refresh
- **Settings**: the Portfolio tab can be chosen as the start tab, and LTV thresholds are checked for a sane range and order — importing unordered thresholds no longer silences the alarms
- **Mobile**: maturity and currency grids collapse to one column; no more horizontal overflow on the Overview

### Security

- **Fixed a cross-site scripting vulnerability.** Loan names, IDs, currencies and notes were rendered without escaping, so a crafted name — typed in or arriving in a shared JSON/CSV file — could execute code with access to all locally stored data. Every user-supplied text is now escaped

### Bug Fixes

**Data safety**
- Unreadable stored data is no longer overwritten with an empty list on the next page load; it is backed up and reported instead
- Failed saves (full storage, private browsing) are now reported instead of silently pretending success
- Damaged import files no longer break the dashboard permanently — invalid records are rejected and counted in the import message
- Transactions are no longer dropped when an import file contains no settings, and follow the chosen merge strategy
- Merging imports no longer creates duplicate loan IDs

**Calculations**
- LTV excluded the BTC fee in the alarms but included it in the loan list, LTV sorting, CSV export, the LTV chart and the timeline — the same loan showed 55.0 % or 57.5 % depending on where you looked
- The LTV calculator reported an LTV without interest and took its interest rate and term from the break-even calculator next to it; it now has its own rate and term fields
- The «Zukunftssimulation» reported today's LTV without interest, so it disagreed with the loan card for the same loan
- The stress test, its heatmap legend and the worst-case simulator printed fixed 73/79/86 prices and labels regardless of the configured thresholds
- The collateral top-up calculator suggested exactly the amount that triggers the margin call it was meant to avoid
- A loan was closed automatically on the morning of the day it was due; it now stays active until the day has passed
- The cash-flow chart skipped the current month, so a loan due in a few days appeared nowhere
- Adding months overflowed month ends: 31.08. + 6 Monate produced the 3rd of March instead of the end of February
- Dates were interpreted in UTC but displayed locally, shifting every date by a day west of UTC — combined with the auto-close rule this closed still-active loans a day early
- Roll-over chains ended at the loan that started last instead of the latest maturity, understating the runtime and overstating the effective rate up to threefold
- The chain break-even divided the cost by the collateral of all members, although a roll-over re-pledges the same bitcoin; without a stored BTC start price it now shows «—» instead of a figure that merely tracked the current price
- The roll-over simulation's effective annual rate ignored its own compounding, and the total fee in BTC was extrapolated from the first period
- The effective cost in BTC counted the fee at today's price instead of the amount actually paid
- «Gesamtkosten — aktive Kredite» included fees of closed loans; the maturity counters included loans repaid early
- Loan progress was based on 30-day months, so a loan could show «100 % vergangen» and «noch 5 Tage» at once
- A `Gebühr` transaction was deducted twice when both the amount and the fee field were filled
- A manually entered BTC reserve was silently reset as soon as a transaction was recorded

**Interface**
- Opening the Diagramme tab with no loans left every chart blank for the rest of the session, even after adding a loan
- When Chart.js could not be loaded (no internet, blocked CDN) the start-up routine was skipped entirely, so exchange rates were never fetched and nothing said why every figure used the built-in fallback rates
- Collateral, amount and interest rate could not be edited to 0 — the old value was silently kept
- Assigning a roll-over predecessor left the predecessor untagged, so the chain contained only one loan and the selection was lost on reopening
- Duplicate loan IDs are rejected instead of quietly breaking edit and delete
- The calendar marked long-past maturities in red as if they were due, and included closed loans
- A rate field cleared with the keyboard stayed empty for the rest of the session while calculations kept using the old rate
- Header tooltips kept showing old figures after the underlying loans were closed
- Multi-line notes no longer truncate a CSV import, and rows the parser cannot use are reported instead of dropped silently
- Stored loans that cannot be read (for example an invalid start date) are reported and preserved instead of disappearing
- In the LTV chart, selecting a loan could show a different one after loans were added or deleted, and new loans never appeared in the selector
- Editing, deleting or applying a historic price could hit the wrong loan after an import or deletion
- The «Aktuell» reference line in the break-even chart never appeared
- Duplicating a loan silently added the copy to the original's roll-over chain
- Reloading on the Portfolio tab fell back to the default tab
- The Overview LTV filter was not remembered
- «Einstellungen zurücksetzen» did not restore all defaults
- Entering a value in the Portfolio reserve field was impossible — it cleared itself on every keystroke
- Editing a rate in the header cleared the field while typing and could flash a false «Kredit liquidiert» warning
- Transactions are now shown with a minus sign for outgoing amounts, and a negative balance is flagged instead of hidden
- The MC1 note on loan cards was garbled once the threshold was breached
- Charts with more than eight loans or currencies used colours that did not match their legend
- The refresh button could stay disabled permanently, and a manually entered rate could be overwritten by a late-arriving price
- JSON export now contains the transactions
- Version numbers in the footer were out of date, and the Portfolio settings card showed its title twice


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
