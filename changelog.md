# Changelog — firefish-dashboard-unofficial

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

