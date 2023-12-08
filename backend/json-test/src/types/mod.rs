
use serde::{Serialize, Deserialize};

#[derive(Serialize, Deserialize)]
pub struct Entry {
    title: String,
    link: Vec<String>,
    pub description: String,
    pubDate: String
}

impl Entry {
    pub fn new(title: &str, description: &str, pubDate: &str) -> Self {
        return Self {
            title: String::from(title),
            link: Vec::new(),
            description: String::from(description),
            pubDate: String::from(pubDate)
        }
    }
}