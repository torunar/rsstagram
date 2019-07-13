# RssTagram

Instagram feed aggregator, built on top of the [RSS-Bridge](https://github.com/RSS-Bridge/rss-bridge) tool.

## How-to

1. Create your own configuration file using the provided example:

    ```
    cp /path/to/repo/config.example.json /path/to/config.json
    ```

2. Set up sources in the configuration file, filling the `sources` array with Instagram usernames:

    ```
    ...
    "sources": [
      "hideo_kojima",
      "thisisbillgates",
      "elonmusk",
      ...
    ]
    ...
    ```

3. Optionally, set the desired title, link and description of your aggregate RSS feed.

4. Run the tool:

    ```
    $ bin/rsstagram /path/to/config.json /path/to/feed.xml
    ```

5. Done! You can now host the resulting `/path/to/feed.xml` anywhere you like.
