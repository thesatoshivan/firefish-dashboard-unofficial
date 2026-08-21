# Changelog — firefish-dashboard-unofficial


---


## v2.1.0 (21.08.2026)

### New Features

**Portfolio-Verlauf (Portfolio tab)**
- A chart of how the whole stack developed, from the month of your first transaction — or your first loan, whichever came first — up to today
- Two series on two axes: the portfolio value in your main currency on the left, the bitcoin holding on the right. The amount barely moves while the value swings, so a shared axis would have flattened one of them into a straight line
- The holding is the **total**: free bitcoin from the transaction ledger plus the collateral that was pledged at that moment. A loan's collateral enters the curve on its start date and leaves it when the loan is closed; top-ups enter on their own date. Same convention as the tiles above, where the ledger is the holding outside the loans and collateral is added on top
- One point per week, counted backwards from today so the last point sits exactly on today and every step is the same length. Each point is valued at the historical BTC price of that very day rather than at today's price, so the curve shows what the stack was actually worth back then — and at weekly resolution it shows the swings a monthly grid smoothed away
- A third line carries the BTC price itself, on its own axis and starting at zero like the value axis. As long as the holding does not change, the two lines run in parallel; where they come apart, the reason was a purchase, a sale or a loan rather than the market
- Only today carries a visible marker; the weekly points appear under the cursor, which keeps the lines readable over a year or more
- The tooltip names the date, the value, the total holding, its split into collateral and free bitcoin, and the BTC price behind it
- Below the chart: the starting point and what set it, the holding today with its split, the current value, and the highest value with the month it occurred in
- Historical prices come from the built-in table where it reaches and from CoinGecko beyond it. If a price cannot be had, that point falls back to the current rate and a line under the chart says how many points are affected — an incomplete curve beats an empty one, as long as it admits it
- If the free holding was overwritten by hand in the settings below, the chart says so and keeps following the ledger: a hand-set number has no history to draw
- The chart is covered by the eye button in the header like every other amount

### Improvements

- **Every extension scenario in «Verlängerungsszenarien» now states the collateral it would take.** The tool priced an extension in interest but said nothing about the bitcoin side, so the question it left open was the one that decides whether an extension is possible at all. Each card now names the collateral the extension would need at 50 % LTV — the double coverage a Firefish loan starts with, not one of the margin-call thresholds, which say when it gets tight rather than what it takes to begin — and either the amount to add on top of what the loan already holds, or that the existing collateral covers it. Measured against the end amount, because that is when the debt is highest
- **The «Offene Schulden» tile in the Portfolio tab now names the debt in bitcoin too.** The currency breakdown under it deliberately leaves out BTC and sats, so the one figure that matters most when the collateral is bitcoin was the one missing — it now stands above the breakdown, at the current rate, matching the header stat to the satoshi
- **The built-in price history now runs to 31.07.2026.** It ended on 31.12.2025, so everything after that had to be fetched from CoinGecko one date at a time — slow, rate-limited, and simply unavailable offline. Seven more months of daily closing prices are built in; the retrospective, the historical valuation in the new chart and the start price of a loan now resolve without a single request for any date up to the end of July 2026


---


## v2.0.0 (21.08.2026)

### Improvements

- **The CZK exchange rate is live now.** BTC, EUR, CHF and PLN came from CoinGecko while CZK sat on a fixed value built into the file and never moved, so every koruna figure drifted further from reality the longer the rate stood. It is fetched with the others; if a rate is missing from a response, that currency keeps its built-in fallback instead of being left with nothing

### Breaking

- **`index.php` is now `index.html`.** The file never held a single line of PHP, and the README had to explain the extension away. The honest name brings three things with it: a double-click opens the file without going through «open with», any static host can serve it, and a server that has PHP no longer runs it through the interpreter — where a future `<?xml` in an embedded SVG would silently swallow part of the page
- **Your data is not affected.** Loans, transactions and settings belong to the page's origin, not to the file name, so renaming changes nothing on a web server. If you open the dashboard straight from disk (`file://`), export a JSON backup first — browsers treat that origin differently from one another
- **Replace your existing `index.php` with `index.html` — do not just add the new file beside it.** The old one holds the previous version of the dashboard and, left in place, most servers keep serving it: the bookmark still works, the page still looks right, and none of the fixes in this release are in it
- Calling the site by its bare address is unaffected either way. `example.com` served `index.php` before and serves `index.html` now; the address bar looks the same. Only links pointing straight at `/index.php` stop working — on Apache, `Redirect 301 /index.php /index.html` in `.htaccess` keeps those alive without any interpreter


---


## v1.7.0 (21.08.2026)

### New Features

**Ablöse-Rechner (Tools → Während Kredit)**
- Answers what it costs to repay every active loan today, and how much bitcoin comes back out of the collateral
- Repayment amount converted into every enabled currency, main currency first, including BTC and sats
- Because loans run in different currencies, the actual debt per loan currency is listed separately as soon as there is more than one — a EUR debt cannot be settled with CHF
- Shows the bitcoin needed at the current price, the total collateral with its fiat value, and what is left over if the repayment is taken out of the collateral; if the collateral does not cover the debt, the shortfall is named as such
- Closes with the total bitcoin holding afterwards — what remains of the collateral plus the bitcoin held outside the loans from the Portfolio tab — and names how the figure is composed. A shortfall enters with a negative sign, so it eats into the cold storage rather than being hidden
- Counts active loans only, and uses principal + interest — the origination fee was already paid when the loan was taken out
- Every active loan can be ticked in or out of the calculation, with **Alle** / **Keine** to switch the lot. All are selected to begin with, a loan added later joins on its own, and the selection survives price and currency changes. Each entry names the loan, its amount and its maturity date, ordered by maturity

**Top up the collateral of an existing loan**
- New **+₿** action on every loan, as a card button and in the table: enter an amount and a date and the collateral is raised
- Before confirming, the dialog shows collateral, LTV and liquidation price as they are and as they would be, plus how far the liquidation price drops in absolute terms and in percent
- Top-ups are kept as separate events with their own date, so the ledger shows bitcoin leaving the stack on the day it actually did rather than back-dated to the loan's start. Repaying the loan books the whole collateral back in one go
- The same optional transaction checkbox as elsewhere; for a loan that is already booked it is ticked by default, because leaving it out would put the ledger out of step

**Loans in the portfolio ledger**
- New checkbox in the loan form, off by default: saving the loan also creates the matching transactions — the collateral as a transfer out of the freely held stack, the origination fee as a fee entry, both dated to the loan's start date and priced at the stored BTC start price. The box resets to off every time the form is opened, and says so if there was nothing to book
- A loan entered as already closed also gets the collateral booked back in, so adding a past loan does not leave the stack permanently short
- The bookings stay linked to their loan and follow it: collateral, fee, date and status all keep up, closing a loan adds the return booking and reopening it takes one away, and a fee set back to zero removes its entry. The edit dialog carries the same box as state — unticking it removes the bookings, ticking it on a loan that has none creates them
- Deleting a loan removes its bookings too, and the confirmation dialog says how many before you confirm
- Only bookings the dashboard created are touched; transactions you entered yourself are never changed or removed
- Each booking's note names the loan and its ID, so a ledger entry can be traced back even after the loan has been renamed

**«BTC nach Schuldentilgung» in the Portfolio overview**
- New tile answering how much bitcoin would be left if the open debt were settled out of the stack: total holding minus the debt converted at the current price
- Names how much bitcoin the debt costs, or by how much the stack falls short of covering it
- Times the BTC price it comes to the net worth shown next to it — the same figure in bitcoin rather than fiat — and it matches the payoff calculator in Tools

**Rückblick — hat sich das Beleihen gelohnt?**
- New section in the statistics. Break-even says from which price a loan pays off; for a loan that is over, this says whether it did
- Per loan: the bitcoin you would have had to sell for the loan amount, what that bitcoin gained, the interest and fee it cost instead, and the difference — the verdict on borrowing rather than selling
- Two separate blocks. **Abgeschlossen** values each loan at the price on its repayment day; that result stands. **Laufend** values the running loans at today's price and moves with it, so the question «as things stand, has borrowing paid off?» has an answer too
- Each block carries its own total and hit rate — a settled result and a provisional one do not belong in the same sum
- Costs are always those of the full term, because the interest is owed to maturity either way. That makes the sign of a running loan agree exactly with the break-even shown on its card
- Loans without a stored start price are left out, and a price that cannot be resolved shows a dash rather than a guess

**Warning when maturities cluster**
- The maturity tiles show what is due within 7, 14, 30 … days, but not that three of those loans fall within eleven days of each other — which is the liquidity risk the sums hide
- A line under the tiles names the largest such group: how many loans, over how many days, the period, the total, and which loans. It turns amber once the group starts inside the countdown window and stays neutral when it is further out
- Closed and overdue loans are left out; among equally sized groups the larger amount wins

**Backup reminder**
- All data lives in this browser and nowhere else — clearing the site's data, a cleanup tool or private mode wipes it without warning. The dashboard now records when the last JSON export happened and says so
- Once per session it warns if the last export is older than the configured number of days, or if there never was one, with a button to export right there
- New **Datensicherung** card in the settings shows the age of the last backup and lets you set the interval; 0 switches the reminder off

**Repayment date on a loan**
- New optional field. The collateral return is otherwise booked on the maturity date, which is wrong for a loan repaid early — entering the real date moves the booking there, and it stays put instead of being derived again on the next edit
- Empty means the maturity date, as before. It only moves the booking: runtime, interest and the automatic close still work off the agreed term
- Travels with JSON and CSV export and import

### Improvements

- **One break-even definition**: break-even was calculated two different ways under the same name. The loan cards, the chart, the statistics and the Tools calculator answer «at what BTC price has holding beaten selling» and divide the cost by the bitcoin you avoided selling; the header stat and the roll-over tables divided the same cost by the pledged collateral instead — under Firefish's twofold overcollateralization about twice as much bitcoin, and therefore roughly half the distance above the start price. The two figures could not both be right, and the header disagreed with every card below it. Header and roll-over tables now use the hold-versus-sell definition as well, and the header's portfolio figure is weighted by loan volume so it matches the weighted break-even in the statistics
- **No more stand-in for a missing start price**: a loan with no stored BTC start price was filled in with the current price, which produced a «break-even» that simply followed the market. Such loans are now left out of the header figure — the tooltip says how many — and their bar in the break-even chart stays empty with a footnote explaining why
- **Effektiver Jahreszins** in the statistics was the plain interest rate annualised, which is the same number as the interest rate itself. It now includes the one-off origination fee, which is what makes it effective, and says so
- **Configured LTV thresholds are followed everywhere**: the heatmap legend and the threshold marks on the loan cards' LTV bars were fixed at 73 % and 86 % while their colours already followed the configured values, so after changing the thresholds the marks sat in the wrong place. The bar's scale also printed «75» where the mark was drawn at 73. Only the 95 % liquidation line stays fixed, because Firefish does
- **Roll-Over-Timeline with a real tooltip**: hovering a bar showed a plain browser tooltip with the name, amount and interest. It now opens a proper panel with the loan's name and ID, its place in the chain, status, amount, rate, term, the period with days remaining, interest, fee, total cost, amount due, and — while the loan is running — collateral, LTV and liquidation price. It stays inside the window at the edges, and tapping works where there is no mouse
- **Historic prices are fetched more gently**: the background prefetch asked for every needed date at once, 300 ms apart — far more than the free CoinGecko API tolerates, so it reliably walked into a rate limit. It now asks for one date at a time, skips dates the cache or the bundled price table already answer, and stops after the first rate limit instead of spending the remaining requests on refusals

### Bug Fixes

- **«Fälliger Betrag» differed depending on where you looked**: the origination fee is paid once in bitcoin when the loan is matched, so it is not part of what has to be repaid at maturity. Most of the dashboard followed that rule, but the table view, the sorting by «Fälliger Betrag», the «Nächste Fälligkeiten» tiles and the expiry notification added the fee on top — a 10'000 loan with 1'000 interest and a 250 fee read 11'000 on the card and 11'250 in the table. All of them now show principal + interest; break-even, which genuinely has to earn the fee back, still counts it
- **«Gewinn/Verlust durch Beleihen» ignored the loan's real fee**: selecting a loan loaded its actual origination fee and then immediately overwrote it with the generic 1.5 %-per-year estimate, so the result never used the fee that was actually paid. The loan's fee now wins over the estimate, a hint names where the value comes from, and clearing the loan selection returns to the estimate
- **Fee fields that could not be typed in**: in «Zu hinterlegende Sicherheit» and «Mit Kredit Bitcoin kaufen» the fee was refilled on every keystroke, so a manually entered fee never survived. Editing the field now marks it as manual; emptying it restores the automatic value. In «Maximaler Kreditbetrag mit Reserve» the fee field stayed permanently empty because the browser rejected its « BTC» suffix — it is a calculated value and is now shown as one
- **The «↺ Auto» reset link** next to the fee in «Gewinn/Verlust durch Beleihen» disappeared as soon as the tool currency was switched, leaving no way back to the automatic value
- **Tools break-even used today's BTC price for the fee**, so its result drifted away from the break-even shown on the loan card as soon as the market moved. It now uses the price at which the loan was taken out, the same basis as everywhere else
- **Verlängerungsszenarien charged interest on the fee**: the extension was calculated on principal + interest + fee, so the already-paid origination fee was interest-bearing for the whole extension
- **The currency breakdown under «Gesamtkosten»** valued the fee at today's BTC price while the tile right above it already used the price at which the fee was paid, so the two lines disagreed
- **CSV import lost a month**: the term was derived from the plain month difference between start and maturity, which loses a month whenever the maturity falls just before the anniversary — a loan from 01.03.2024 to 28.02.2025 was imported as 11 months and therefore with too little interest. The term is now the one whose calculated maturity comes closest to the imported one
- **A custom navigation order was lost on restore.** The sidebar order set in the settings was saved locally but never written to the JSON export, so restoring from a backup — or moving to another device — silently returned to the default order
- **The transaction ledger lists the newest entry first.** It was ordered oldest first, so the entry you had just made ended up at the bottom of a growing table. Entries sharing a date keep their order, and the balance is unchanged — it is a sum over all entries, not a running total per row
- **Notices were hidden behind the sidebar**: every message the dashboard shows — including the warnings about storage that could not be read or written — was placed at the very top left of the page, where the fixed sidebar covered all but its right-hand end. They now sit in the content area and are readable
- **The LTV history chart read the wrong day's price**: daily prices from CoinGecko are stamped at UTC midnight but were keyed by the local date, so west of Greenwich every entry landed on the previous day and each day's ratio was measured against the wrong price


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
