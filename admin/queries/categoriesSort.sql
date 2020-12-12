SELECT 
	a.id_users_categories, 
	a.date, 
    CASE
        WHEN a.video = 1 THEN 'video'
        ELSE ''
    END as video,
    CASE
        WHEN a.writter = 1 THEN 'writter'
        ELSE ''
    END as writter,
    CASE
        WHEN a.developer = 1 THEN 'developer'
        ELSE ''
    END as developer, 
    CASE
        WHEN a.podcaster = 1 THEN 'podcaster'
        ELSE ''
    END as podcaster,
    CASE
        WHEN a.artist = 1 THEN 'artist'
        ELSE ''
    END as artist,
    CASE
        WHEN a.influencer = 1 THEN 'influencer'
        ELSE ''
    END as influencer,
    CASE
        WHEN a.other = 1 THEN 'other'
        ELSE ''
    END as other,
    c.user_name, 
    c.about, 
    c.creation FROM users_categories as a 
INNER JOIN (SELECT id_user, MAX(date) as max_date 
            FROM users_categories GROUP by id_user) as b on a.date=b.max_date
LEFT JOIN users as c on c.id_user=a.id_user
WHERE c.active=1