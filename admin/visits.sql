SELECT COUNT(a.section) as visits, DATE(a.date), a.section as section FROM visitors as a GROUP BY DATE(a.date) WITH ROLLUP