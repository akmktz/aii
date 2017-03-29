SELECT id, tags
FROM blog_posts
WHERE MATCH(tags) AGAINST ('fjweb' IN BOOLEAN MODE) > 0