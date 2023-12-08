use serde_json;
use json_test::types::Entry;

pub fn main() {
    let data_string = r###"
{
    "title": "Bowden: I had prostate cancer in 2007 (AP)",
    "link": [
        "http://us.rd.yahoo.com/sports/rss/top/SIG=11sb0oir9/*http%3A//sports.yahoo.com/ncaaf/news?slug=ap-bowden-cancer",
        "urn:newsml:sports.yahoo,ap:20050301:ncaaf,article,ap-bowden-cancer:1"
    ],
    "description": "<p><a href=\"http://us.rd.yahoo.com/sports/rss/top/SIG=11sb0oir9/*http%3A//sports.yahoo.com/ncaaf/news?slug=ap-bowden-cancer\"><img src=\"http://l.yimg.com/a/p/sp/tools/med/2011/09/ipt/1315914809.jpg\"  width=\"75\" height=\"75\"  alt=\"Bobby Bowden\" align=\"left\" border=\"0\"></a></p><p>Former Florida State football coach Bobby Bowden revealed he was successfully treated for prostate cancer in 2007, making the rounds Tuesday in New York to tell his story. Although he had kept it secret for more than four years, Bowden said he believed it was now \"my moral duty to bring it out in the open.\" Bowden, who turns 82 in early November, appeared on several morning television...</p><br clear=\"all\" />",
    "pubDate": "Tue, 13 Sep 2011 14:20:27 PDT"
}
"###;

    if let Ok(converted) = serde_json::to_string_pretty(&Entry::new("title", "description", "pub date")) {
        println!("converted: {}\n", converted);
    }

    if let Ok(converted) = serde_json::from_str::<Entry>(data_string) {
        println!("converted: {}\n", converted.description);
    }
}