-- 랭킹 알아내는 쿼리
select name, score, @curRank := @curRank+1 from game_1plus2 g, (select @curRank := 0) r order by score desc;

-- 20 등까지만 알아내는 쿼리
select name, score, @curRank := @curRank+1 as rank from game_1plus2 g, (select @curRank := 0) r order by score desc, reg_time limit 20

-- 2 등에 해당하는 점수보다 작은 데이터 찾는 예제(ex, limit is started at 0)
select * from game_1plus2 where score < (select score from game_1plus2 order by score desc limit 1,1);

