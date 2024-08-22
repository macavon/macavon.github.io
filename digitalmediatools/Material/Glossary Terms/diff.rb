#!/usr/bin/env ruby
#
#  Created by Nigel Chapman on 2007-10-13.
#  Copyright (c) 2007. All rights reserved.

xrefs = IO.readlines("xrefs")
terms = IO.readlines("dmt_glossary.csv")

print xrefs - terms
